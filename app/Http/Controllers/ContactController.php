<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Notifications\NewInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Send a property inquiry
     */
    public function sendInquiry(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Send notification to property owner
        $property->user->notify(new NewInquiryNotification(
            $property,
            $request->name,
            $request->email,
            $request->message
        ));

        return back()->with('success', 'Your inquiry has been sent successfully! The property owner will contact you soon.');
    }

    /**
     * Show contact form
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Send general contact message
     */
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Send email to admin
        Mail::send('emails.contact', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messageContent' => $request->message,
        ], function ($message) use ($request) {
            $message->to(config('mail.from.address'))
                ->subject('Contact Form: ' . $request->subject)
                ->replyTo($request->email, $request->name);
        });

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
