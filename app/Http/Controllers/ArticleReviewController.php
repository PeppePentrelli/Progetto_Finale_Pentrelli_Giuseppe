<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleReviewController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'text' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        ArticleReview::create([
            'article_id' => $article->id,
            'user_id' => Auth::id(),
            'text' => $request->text,
            'rating' => $request->rating,
            'approved' => false,
        ]);

        return redirect()->back()->with('success', 'Recensione inviata! In attesa di approvazione.');
    }
}
