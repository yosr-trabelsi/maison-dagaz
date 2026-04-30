<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class VendeurController extends Controller
{
    
    public function show($id)
    {
        $vendeur  = User::findOrFail($id);
        $products = Product::with('reviews')
            ->where('user_id', $id)
            ->latest()
            ->get();

       
        $totalRatings = $products->flatMap(fn($p) => $p->reviews)->avg('rating');
        $totalReviews = $products->flatMap(fn($p) => $p->reviews)->count();

        return view('vendeur.show', compact('vendeur', 'products', 'totalRatings', 'totalReviews'));
    }

   
    public function dashboard()
    {
        $userId   = Auth::id();
        $vendeur  = Auth::user();

       
        $products = Product::with('reviews')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        
        $totalProducts = $products->count();
        $avgRating     = $products->flatMap(fn($p) => $p->reviews)->avg('rating') ?? 0;
        $totalReviews  = $products->flatMap(fn($p) => $p->reviews)->count();

        $myProductIds = $products->pluck('id')->toArray();

        $orderItems = OrderItem::with(['order', 'product'])
            ->whereIn('product_id', $myProductIds)
            ->latest()
            ->get();

        $totalVentes  = $orderItems->sum(fn($i) => $i->price * $i->quantity);
        $totalOrders  = $orderItems->pluck('order_id')->unique()->count();

        return view('vendeur.dashboard', compact(
            'vendeur',
            'products',
            'totalProducts',
            'avgRating',
            'totalReviews',
            'orderItems',
            'totalVentes',
            'totalOrders'
        ));
    }
}