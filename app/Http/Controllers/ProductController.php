<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|string',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'category'    => $request->category,
            'description' => $request->description,
            'image'       => $imageName,
            'user_id'     => auth()->id(),
        ]);

        return redirect('/')->with('success', 'Produit ajouté avec succès !');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        if (!auth()->user()->isAdmin() && $product->user_id != auth()->id()) {
            abort(403);
        }

        return view('edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|string',
            'description' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        if (!auth()->user()->isAdmin() && $product->user_id != auth()->id()) {
            abort(403);
        }

        $product->update($request->only('name', 'price', 'category', 'description'));

        return redirect('/')->with('success', 'Produit mis à jour avec succès !');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        if (!auth()->user()->isAdmin() && $product->user_id != auth()->id()) {
            abort(403);
        }

        $product->delete();

        return redirect('/')->with('success', 'Produit supprimé.');
    }

    public function addReview(Request $request, $id)
    {
        $product = Product::findOrFail($id);

       
        if (auth()->check() && $product->user_id == auth()->id()) {
            return redirect()->back()->with('error', ' Vous ne pouvez pas noter votre propre produit.');
        }

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'product_id' => $id,
            'user_id'    => auth()->id(),
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return redirect()->back()->with('success', ' Avis ajouté avec succès !');
    }
}
