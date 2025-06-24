<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contactUs(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:500',
            'body' => 'required|string|max:5000',
        ]);

        $toEmail = env('CONTACT_US_EMAIL');

        Mail::to($toEmail)->queue(new \App\Mail\ContactUs(
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['subject'],
            $validatedData['body']
        ));

        return response()->json([
            'http_status' => 200,
            'http_status_message' => 'OK',
            'message' => 'Your message has been sent successfully.',
        ]);
    }
}
