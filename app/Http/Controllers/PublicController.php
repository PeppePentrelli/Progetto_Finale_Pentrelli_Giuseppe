<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
    {
        $reviews = Review::where('approved', true)->latest()->get();
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->take(6)->get();
        return view('welcome', compact('articles', 'reviews'));
    }

    // Funzione per ricercare articoli
    public function searchArticles(Request $request)
    {
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->paginate(10);
        return view('article.searched', ['articles' => $articles, 'query' => $query]);
    }

    // funzione per cambiare lingua

    public function setLenguage($lang)
    {

        session()->put('locale', $lang);
        return redirect()->back();
    }

    // Pagina chi siamo 

    public function aboutUSFunction()
    {
        return view('aboutUs');
    }
}
