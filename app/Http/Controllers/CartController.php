<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('article')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, Article $article)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('article_id', $article->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'article_id' => $article->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Articolo aggiunto al carrello!');
    }

    public function remove(Cart $cartItem)
    {
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Articolo rimosso dal carrello!');
    }
}
