<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Ecourse;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;

class CartController extends ApiBaseController
{
    /**
     * Get user's cart
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            
            $cartItems = Cart::where('user_id', $user->id)
                ->with('item')
                ->get();
                
            $total = $cartItems->sum(function ($item) {
                $price = $item->discount_price ?? $item->price;
                return $price * $item->quantity;
            });

            return $this->success([
                'items' => $cartItems,
                'total' => $total,
                'count' => $cartItems->count(),
            ], 'Cart retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve cart', $e->getMessage(), 500);
        }
    }

    /**
     * Add item to cart
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'item_type' => 'required|string|in:ecourse,event',
                'item_id' => 'required|integer',
                'quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            // Get the item
            if ($request->item_type === 'ecourse') {
                $item = Ecourse::active()->findOrFail($request->item_id);
            } else if ($request->item_type === 'event') {
                $item = Event::where('is_active', true)
                    ->where('status', 'open')
                    ->findOrFail($request->item_id);
            } else {
                return $this->error('Invalid item type');
            }
            
            // Check if item is already in cart
            $existingItem = Cart::where('user_id', $user->id)
                ->where('item_type', $request->item_type)
                ->where('item_id', $request->item_id)
                ->first();
                
            if ($existingItem) {
                // Update quantity
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $request->quantity,
                ]);
                
                $cartItem = $existingItem;
            } else {
                // Add new item to cart
                $cartItem = Cart::create([
                    'user_id' => $user->id,
                    'item_type' => $request->item_type,
                    'item_id' => $request->item_id,
                    'quantity' => $request->quantity,
                    'price' => $item->price,
                    'discount_price' => $item->discount_price,
                ]);
            }
            
            // Load item relationship
            $cartItem->load('item');

            return $this->success($cartItem, 'Item added to cart successfully', 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Item not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to add item to cart', $e->getMessage(), 500);
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'quantity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            $cartItem = Cart::where('user_id', $user->id)
                ->findOrFail($id);
                
            $cartItem->update([
                'quantity' => $request->quantity,
            ]);

            return $this->success($cartItem, 'Cart item updated successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Cart item not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to update cart item', $e->getMessage(), 500);
        }
    }

    /**
     * Remove item from cart
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $cartItem = Cart::where('user_id', $user->id)
                ->findOrFail($id);
                
            $cartItem->delete();

            return $this->success(null, 'Item removed from cart successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Cart item not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to remove item from cart', $e->getMessage(), 500);
        }
    }

    /**
     * Clear cart
     */
    public function clear(Request $request)
    {
        try {
            $user = $request->user();
            
            Cart::where('user_id', $user->id)->delete();

            return $this->success(null, 'Cart cleared successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to clear cart', $e->getMessage(), 500);
        }
    }
}