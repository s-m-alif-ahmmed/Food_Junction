<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function cart(): View
    {
        $cart = $this->cartService->getCart();
        // Ensure totals are up-to-date
        $this->cartService->calculateTotals($cart);
        
        // Pass the single cart to the view, which has relations ->items
        // that contain the product and quantity details
        return view('frontend.pages.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $newWeight = $request->input('weight');
            $newQuantity = $request->input('quantity');
            $variantUnit = $request->input('variant_unit');

            $cart = $this->cartService->addItem($productId, $newWeight, $newQuantity, $variantUnit);

            return response()->json([
                'success' => true,
                't-success' => 'Cart updated successfully!',
                'cart' => $cart,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                't-error' => 'Failed to add item to cart!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $this->cartService->removeItem($productId);

            return redirect()->back()->with('t-success', 'Item removed from cart.');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart.',
                't-error' => $e->getMessage(),
            ], 500);
        }
    }

}
