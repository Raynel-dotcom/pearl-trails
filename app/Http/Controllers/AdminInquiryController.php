<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminInquiryController extends Controller
{
    /**
     * Display all customer contact inquiries.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.messages', compact('messages'));
    }

    /**
     * Delete an inquiry.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages')->with('success', 'Inquiry message removed.');
    }
}
