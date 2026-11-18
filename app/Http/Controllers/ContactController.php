<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contactMessage = ContactMessage::create($validated);

        // Dispatch direct email notification to the site administrator
        $adminEmail = config('site.email');
        if (!empty($adminEmail)) {
            try {
                Mail::to($adminEmail)->send(new ContactInquiryMail($validated));
            } catch (\Throwable $e) {
                Log::error("Failed to send contact notification email: " . $e->getMessage());
            }
        }

        return redirect()->route('contact')->with([
            'contact_success'   => true,
            'submitted_name'    => $validated['name'],
            'submitted_message' => $validated['message'],
        ]);
    }
}
