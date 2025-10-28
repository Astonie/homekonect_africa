<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\PropertyDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the documents.
     */
    public function index(Request $request)
    {
        $query = PropertyDocument::where('user_id', auth()->id());

        // Filter by document type
        if ($request->filled('type')) {
            $query->where('document_type', $request->type);
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter expired documents
        if ($request->filled('expired')) {
            if ($request->expired === 'yes') {
                $query->where('expiry_date', '<', now());
            } elseif ($request->expired === 'no') {
                $query->where(function($q) {
                    $q->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>=', now());
                });
            }
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(12);
        
        $stats = [
            'total' => PropertyDocument::where('user_id', auth()->id())->count(),
            'expired' => PropertyDocument::where('user_id', auth()->id())
                ->where('expiry_date', '<', now())
                ->count(),
            'expiring_soon' => PropertyDocument::where('user_id', auth()->id())
                ->whereBetween('expiry_date', [now(), now()->addDays(30)])
                ->count(),
        ];

        return view('landlord.documents.index', compact('documents', 'stats'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        return view('landlord.documents.create');
    }

    /**
     * Store a newly created document in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'document_type' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // 10MB max
            'description' => 'nullable|string',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents/' . auth()->id(), $fileName, 'public');

        PropertyDocument::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'document_type' => $request->document_type,
            'file_path' => $filePath,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'file_extension' => $file->getClientOriginalExtension(),
            'description' => $request->description,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('landlord.documents.index')
            ->with('success', 'Document uploaded successfully!');
    }

    /**
     * Display the specified document.
     */
    public function show(PropertyDocument $document)
    {
        // Ensure the document belongs to the authenticated landlord
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        return view('landlord.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified document.
     */
    public function edit(PropertyDocument $document)
    {
        // Ensure the document belongs to the authenticated landlord
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        return view('landlord.documents.edit', compact('document'));
    }

    /**
     * Update the specified document in storage.
     */
    public function update(Request $request, PropertyDocument $document)
    {
        // Ensure the document belongs to the authenticated landlord
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'document_type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'description' => 'nullable|string',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        $data = [
            'title' => $request->title,
            'document_type' => $request->document_type,
            'description' => $request->description,
            'expiry_date' => $request->expiry_date,
        ];

        // If new file is uploaded
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($document->file_path);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('documents/' . auth()->id(), $fileName, 'public');

            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
            $data['file_extension'] = $file->getClientOriginalExtension();
        }

        $document->update($data);

        return redirect()->route('landlord.documents.index')
            ->with('success', 'Document updated successfully!');
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(PropertyDocument $document)
    {
        // Ensure the document belongs to the authenticated landlord
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete file from storage
        Storage::disk('public')->delete($document->file_path);

        $document->delete();

        return redirect()->route('landlord.documents.index')
            ->with('success', 'Document deleted successfully!');
    }

    /**
     * Download the document file
     */
    public function download(PropertyDocument $document)
    {
        // Ensure the document belongs to the authenticated landlord
        if ($document->user_id !== auth()->id()) {
            abort(403);
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}
