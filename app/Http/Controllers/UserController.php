<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        return view('user.show', compact('user'));
    }

    public function updateImages(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Devi essere loggato per aggiornare le immagini.');
        }

        $request->validate([
            'profile_image' => 'nullable|image|max:2048',
            'cover_image'   => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('users/profile', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $user->cover_image = $request->file('cover_image')->store('users/cover', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Immagini aggiornate con successo!');
    }
}
