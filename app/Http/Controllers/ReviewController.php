<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review.
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title'  => 'nullable|string|max:255',
            'body'   => 'nullable|string',
        ]);

        // Check if user already reviewed this product
        $existing = Review::where('user_id', Auth::id())
                          ->where('product_id', $productId)
                          ->first();

        if ($existing) {
            return redirect()->back()
                             ->with('error', 'You already reviewed this product!');
        }

        Review::create([
            'user_id'    => Auth::id(),
            'product_id' => $productId,
            'rating'     => $request->rating,
            'title'      => $request->title,
            'body'       => $request->body,
        ]);

        return redirect()->back()
                         ->with('success', 'Review added successfully!');
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = Review::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        $review->delete();

        return redirect()->back()
                         ->with('success', 'Review deleted!');
    }
}