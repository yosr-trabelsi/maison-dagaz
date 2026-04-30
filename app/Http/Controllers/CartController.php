<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id === auth()->id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas acheter votre propre produit.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'category' => $product->category,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        session()->save();

        return redirect()->route('cart.index')->with('success', $product->name . ' a ete ajoute au panier.');
    }

    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += (float) $item['price'] * (int) $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit retire du panier.');
    }

    public function update($id)
    {
        $cart     = session()->get('cart', []);
        $quantity = (int) request('quantity');

        if (isset($cart[$id])) {
            if ($quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $quantity;
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Panier mis a jour.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += (float) $item['price'] * (int) $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
            'status'  => 'En attente',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect('/confirmation')->with('success', 'Commande passee avec succes.');
    }
}