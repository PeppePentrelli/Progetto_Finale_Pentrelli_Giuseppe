<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterConfirmationMail;

class NewsletterController extends Controller
{
    /**

     */
    public function subscribe(Request $request)
    {

        $request->validate([
            'email'   => 'required|email|unique:newsletters,email',
            'nome'    => 'nullable|string|max:255',
            'cognome' => 'nullable|string|max:255',
        ]);


        $subscriber = Newsletter::create([
            'nome'    => $request->nome,
            'cognome' => $request->cognome,
            'email'   => $request->email,
        ]);


        Mail::to($subscriber->email)->send(
            new NewsletterConfirmationMail($subscriber->nome)
        );

        return back()->with('success', 'Grazie per esserti iscritto alla nostra newsletter!');
    }

    /**

     */
    public function index()
    {

        $subscribers = Newsletter::latest()->get();


        return view('revisor.newsletters', compact('subscribers'));
    }
}
