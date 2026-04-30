<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;

class OwnerMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    $product = Product::find($request->id);

    
    if (!$product) {
        abort(404);
    }

    
    if ($product->user_id != auth()->id()) {
        return redirect('/')
            ->with('error', ' You are not the owner of this product');
    }

    return $next($request);
}
}

