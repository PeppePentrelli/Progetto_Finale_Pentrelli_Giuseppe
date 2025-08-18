<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
            'rating' => $request->rating,
            'approved' => false,
        ]);

        return redirect()->back()->with('success', 'Recensione inviata! In attesa di approvazione.');
    }
}
