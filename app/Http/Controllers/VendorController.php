<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeVendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    // Lista di tutti i venditori
    public function index()
    {
        $vendors = User::where('is_vendor', true)
            ->withCount('articles')
            ->paginate(6);
        return view('uservendor.index', compact('vendors'));
    }

    // profilo di un singolo venditore
    public function show($id)
    {
        $vendor = User::where('is_vendor', true)
            ->with(['articles' => function ($query) {
                $query->latest();
            }])
            ->findOrFail($id);

        return view('uservendor.show', compact('vendor'));
    }


    public function makeVendor(User $user)
    {
        $user->is_vendor = true;
        $user->save();

        return redirect()->route('homepage')->with('success', "{$user->name} è ora un venditore!");
    }


    public function becomeVendor()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Devi effettuare il login per fare richiesta.');
        }


        Mail::to('adminMail@Presto.com')->send(new BecomeVendor($user));

        return redirect()->route('homepage')->with('success', 'Richiesta per diventare venditore inviata!');
    }
}
