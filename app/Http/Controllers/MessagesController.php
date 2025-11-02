<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    /**
     * Display all conversations for the authenticated user
     */
    public function index()
    {
        $conversations = Conversation::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['property', 'sender', 'receiver', 'latestMessage'])
            ->orderBy('last_message_at', 'desc')
            ->get();

        return view('messages.index', compact('conversations'));
    }

    /**
     * Show a specific conversation
     */
    public function show(Conversation $conversation)
    {
        // Check if user is part of this conversation
        if ($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this conversation.');
        }

        // Load messages
        $messages = $conversation->messages()->with('sender')->get();

        // Mark messages as read
        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $otherUser = $conversation->getOtherUser(Auth::id());

        return view('messages.show', compact('conversation', 'messages', 'otherUser'));
    }

    /**
     * Start a new conversation from property inquiry
     */
    public function startConversation(Request $request, Property $property)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Check if conversation already exists
        $conversation = Conversation::where('property_id', $property->id)
            ->where(function ($query) use ($property) {
                $query->where(function ($q) use ($property) {
                    $q->where('sender_id', Auth::id())
                      ->where('receiver_id', $property->user_id);
                })->orWhere(function ($q) use ($property) {
                    $q->where('sender_id', $property->user_id)
                      ->where('receiver_id', Auth::id());
                });
            })
            ->first();

        // Create new conversation if doesn't exist
        if (!$conversation) {
            $conversation = Conversation::create([
                'property_id' => $property->id,
                'sender_id' => Auth::id(),
                'receiver_id' => $property->user_id,
                'last_message_at' => now(),
            ]);
        }

        // Create message
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Update conversation last message time
        $conversation->update(['last_message_at' => now()]);

        return redirect()->route('messages.show', $conversation)
            ->with('success', 'Message sent successfully!');
    }

    /**
     * Send a message in existing conversation
     */
    public function sendMessage(Request $request, Conversation $conversation)
    {
        // Check if user is part of this conversation
        if ($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this conversation.');
        }

        $request->validate([
            'message' => 'required_without:attachment|string|max:1000',
            'attachment' => 'nullable|file|max:20480|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt,zip,rar',
        ]);

        $messageData = [
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $request->message ?? '',
            'message_type' => 'text',
        ];

        // Handle file attachment
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            
            // Store file in storage/app/messages/attachments
            $path = $file->store('messages/attachments', 'public');
            
            $messageData['message_type'] = 'file';
            $messageData['attachment_path'] = $path;
            $messageData['attachment_name'] = $file->getClientOriginalName();
            $messageData['attachment_type'] = $file->getMimeType();
            $messageData['attachment_size'] = $file->getSize();
            
            // If no message text, set a default message
            if (empty($messageData['message'])) {
                $messageData['message'] = '📎 Sent an attachment';
            }
        }

        Message::create($messageData);

        // Update conversation last message time
        $conversation->update(['last_message_at' => now()]);

        return back();
    }

    /**
     * Delete a conversation
     */
    public function destroy(Conversation $conversation)
    {
        // Check if user is part of this conversation
        if ($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this conversation.');
        }

        $conversation->delete();

        return redirect()->route('messages.index')
            ->with('success', 'Conversation deleted successfully!');
    }

    /**
     * Download message attachment
     */
    public function downloadAttachment(Message $message)
    {
        // Check if user is part of this conversation
        $conversation = $message->conversation;
        if ($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this attachment.');
        }

        // Check if message has attachment
        if (!$message->hasAttachment()) {
            abort(404, 'Attachment not found.');
        }

        $filePath = storage_path('app/public/' . $message->attachment_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $message->attachment_name);
    }
}
