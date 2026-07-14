<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function contractShow(){
        $setting = Setting::first();
        return view('contact', compact('setting'));
    }

    public function contractStore(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|max:30',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully.');
    }

    public function adminContactShow(){
        $contacts = Contact::latest()->get();

        return view('admin.contact.contact_show', compact('contacts'));
    }

    public function contactDestroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }
}
