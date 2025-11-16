<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart[] = [
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade
        ];

        session()->put('cart', $cart);

        return response()->json($cart);
    }

    public function showCart()
    {
        return response()->json(session('cart', []));
    }

    public function updateCart(Request $request, $index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            $cart[$index]['quantidade'] = $request->quantidade;
            session()->put('cart', $cart);
        }

        return response()->json($cart);
    }

    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart));
        }

        return response()->json(session('cart'));
    }
}