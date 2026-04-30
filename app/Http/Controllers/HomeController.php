<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $query = Product::with(['user', 'reviews.user']);

        
        if (request('search')) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                  ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

     
        if (request('category')) {
            $query->where('category', request('category'));
        }

        switch (request('sort')) {
            case 'price_asc':  $query->orderBy('price', 'asc');  break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'date_asc':   $query->orderBy('created_at', 'asc');  break;
            case 'date_desc':  $query->orderBy('created_at', 'desc'); break;
            default:           $query->latest(); break;
        }

        $products = $query->get();

        
        $recommendations = $this->getRecommendations();

        return view('home', compact('products', 'recommendations'));
    }

    private function getRecommendations()
    {
        
        $allProducts = Product::with('reviews')->get();

       
        $ratedProducts = $allProducts->filter(fn($p) => $p->reviews->count() > 0);

        if ($ratedProducts->isEmpty()) {
            return collect(); 
        }

        if (Auth::check()) {
            $userId = Auth::id();

           
            $likedCategories = Review::where('user_id', $userId)
                ->where('rating', '>=', 4)
                ->with('product')
                ->get()
                ->pluck('product.category')
                ->filter()
                ->unique()
                ->values();

         
            $alreadyReviewedIds = Review::where('user_id', $userId)
                ->pluck('product_id')
                ->toArray();

            if ($likedCategories->isNotEmpty()) {
                
                $recommendations = $ratedProducts
                    ->whereIn('category', $likedCategories->toArray())
                    ->whereNotIn('id', $alreadyReviewedIds)
                    ->sortByDesc(fn($p) => $p->reviews->avg('rating'))
                    ->take(4)
                    ->values();

                
                if ($recommendations->count() < 4) {
                    $existingIds = $recommendations->pluck('id')->toArray();

                    $complement = $ratedProducts
                        ->whereNotIn('id', $existingIds)
                        ->sortByDesc(fn($p) => $p->reviews->avg('rating'))
                        ->take(4 - $recommendations->count())
                        ->values();

                    $recommendations = $recommendations->merge($complement)->values();
                }

                return $recommendations;
            }

         
            return $ratedProducts
                ->whereNotIn('id', $alreadyReviewedIds)
                ->sortByDesc(fn($p) => $p->reviews->avg('rating'))
                ->take(4)
                ->values();
        }

        
        return $ratedProducts
            ->sortByDesc(fn($p) => $p->reviews->avg('rating'))
            ->take(4)
            ->values();
    }
}