<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Article;
use App\Mail\BecomeRevisor;
use Illuminate\Http\Request;
use App\Models\ArticleReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{

    public function show()
    {
        $article_to_check = Article::whereNull('is_accepted')->first();


        return view('revisor.show', compact('article_to_check'));
    }

    // Accetta articolo e mostra il prossimo
    public function accept(Article $article)
    {
        $article->is_accepted = true;
        $article->save();

        return redirect()->route('revisor.show')->with('message', "Hai accettato l'articolo {$article->title}");
    }

    // Rifiuta articolo e mostra il prossimo
    public function reject(Article $article)
    {
        $article->is_accepted = false;
        $article->save();

        return redirect()->route('revisor.show')->with('message', "Hai rifiutato l'articolo {$article->title}");
    }

    // Invio mail richiesta diventare revisore
    public function becomeRevisor()
    {
        Mail::to('adminMail@Presto.com')->send(new BecomeRevisor(Auth::user()));
        return redirect()->route('homepage')->with('success', 'Richiesta per diventare revisore inviata!');
    }

    // Accetta un utente come revisore
    public function makeRevisor(User $user)
    {
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->back();
    }


    // Approva recensione sito
    public function approveSiteReview(Review $review)
    {
        $review->approved = true;
        $review->save();

        return redirect()->back()->with('success', 'Recensione sito approvata!');
    }

    // Rifiuta recensione sito
    public function rejectSiteReview(Review $review)
    {
        $review->approved = false;
        $review->save();

        return redirect()->back()->with('error', 'Recensione sito rifiutata!');
    }

    public function reviews()
    {
        // Recensioni articoli non approvate
        $articleReviews = ArticleReview::with(['user', 'article'])
            ->where('approved', false)
            ->latest()
            ->paginate(10);

        // Recensioni sito non approvate
        $siteReviews = Review::with('user')
            ->where('approved', false)
            ->latest()
            ->paginate(10);

        return view('revisor.reviews', compact('articleReviews', 'siteReviews'));
    }

    // Approva recensione articolo
    public function approveArticleReview(ArticleReview $review)
    {
        $review->approved = true;
        $review->save();

        return redirect()->back()->with('success', 'Recensione articolo approvata!');
    }

    // Rifiuta recensione articolo
    public function rejectArticleReview(ArticleReview $review)
    {
        $review->approved = false;
        $review->save();

        return redirect()->back()->with('error', 'Recensione articolo rifiutata!');
    }
}
