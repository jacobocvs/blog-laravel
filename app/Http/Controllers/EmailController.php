<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;

class EmailController extends Controller
{
    public function welcomeEmail()
    {
        Mail::send(new Welcome());

        return redirect()->back()->with('success', 'Welcome email sent successfully!');
    }

    public function newsletterEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.unique' => 'The email address is already subscribed.'
        ]);

        $subscriber = \App\Models\Newsletter::create([
            'email' => $request->email,
        ]);

        Mail::to($subscriber->email)->send(new Newsletter($subscriber));

        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
