<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers    = User::where('is_admin', false)->count();
        $totalProducts = Product::count();
        $totalOrders   = Order::count();
        $recentUsers   = User::where('is_admin', false)->latest()->take(5)->get();
        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrders', 'recentUsers'));
    }

    public function users()
    {
        $users = User::where('is_admin', false)->withCount('products')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->isAdmin()) abort(403);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function products()
    {
        $products = Product::with('user')->latest()->get();
        return view('admin.products', compact('products'));
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success', 'Produit supprimé avec succès.');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|string',
            'description' => 'required|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'price', 'category', 'description'));
        return redirect()->route('admin.products')->with('success', 'Produit mis à jour avec succès.');
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }
}
