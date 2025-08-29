<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
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

    public function increment(Cart $cartItem)
{
    if ($cartItem->user_id === Auth::id()) {
        $cartItem->increment('quantity');
    }
    return redirect()->back();
}

public function decrement(Cart $cartItem)
{
    if ($cartItem->user_id === Auth::id()) {
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete(); 
        }
    }
    return redirect()->back();
}

// Logiche acwquisto
public function checkout()
{
    $cartItems = Cart::with('article')
        ->where('user_id', Auth::id())
        ->get();

    return view('cart.checkout', compact('cartItems'));
}

public function processCheckout(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:100',
        'postal_code' => 'required|string|max:20',
        'province' => 'required|string|max:50',
        'phone' => 'nullable|string|max:20',
        'shipping_method' => 'required|string',
    ]);

    $cartItems = Cart::with('article')->where('user_id', Auth::id())->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Il carrello è vuoto!');
    }

    $order = Order::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'surname' => $request->surname,
        'address' => $request->address,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
        'province' => $request->province,
        'phone' => $request->phone,
        'shipping_method' => $request->shipping_method,
        'notes' => $request->notes,
        'total' => $cartItems->sum(fn($item) => $item->article->price * $item->quantity),
        'status' => 'in attesa',
    ]);

    foreach ($cartItems as $item) {
        $order->items()->create([
            'article_id' => $item->article_id,
            'quantity' => $item->quantity,
            'price' => $item->article->price,
        ]);
    }

    Cart::where('user_id', Auth::id())->delete();

    return redirect()->route('cart.index')->with('success', 'Ordine effettuato con successo!');
}

public function indexForRevisor()
{
    $orders = Order::with('user')->latest()->paginate(10);
    return view('revisor.orders.index', compact('orders'));
}

public function showForRevisor(Order $order)
{
    return view('revisor.orders.show', compact('order'));
}



}
