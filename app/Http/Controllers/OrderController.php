<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user's orders
     */
    public function index(Request $request)
    {
        $query = Order::with('orderItems.course')
            ->where('user_id', Auth::id());

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status != '') {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by order number
        if ($request->has('search') && $request->search != '') {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Display specific order
     */
    public function show(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Load order items with courses
        $order->load('orderItems.course');

        return view('orders.show', compact('order'));
    }

    /**
     * Download order invoice
     */
    public function downloadInvoice(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if order is paid
        if ($order->payment_status !== 'paid') {
            return redirect()->back()->with('error', 'Invoice hanya tersedia untuk order yang sudah dibayar');
        }

        // Load order items with courses
        $order->load('orderItems.course');

        // Generate PDF invoice (you'll need to install a PDF library like dompdf)
        // For now, return a view that can be printed
        return view('orders.invoice', compact('order'));
    }

    /**
     * Get order statistics for user dashboard
     */
    public function getStats()
    {
        $userId = Auth::id();

        $stats = [
            'total_orders' => Order::where('user_id', $userId)->count(),
            'completed_orders' => Order::where('user_id', $userId)->where('status', 'completed')->count(),
            'pending_orders' => Order::where('user_id', $userId)->where('status', 'pending')->count(),
            'total_spent' => Order::where('user_id', $userId)->where('payment_status', 'paid')->sum('total'),
            'recent_orders' => Order::with('orderItems.course')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }

    /**
     * Reorder items from previous order
     */
    public function reorder(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
        }

        try {
            $addedItems = 0;
            $unavailableItems = [];

            foreach ($order->orderItems as $item) {
                // Check if course is still available
                if ($item->course && $item->course->is_active) {
                    // Check if item is already in cart
                    $existingCartItem = \App\Models\Cart::where('user_id', Auth::id())
                        ->where('course_id', $item->course_id)
                        ->first();

                    if (!$existingCartItem) {
                        \App\Models\Cart::create([
                            'user_id' => Auth::id(),
                            'course_id' => $item->course_id,
                            'quantity' => $item->quantity
                        ]);
                        $addedItems++;
                    }
                } else {
                    $unavailableItems[] = $item->course ? $item->course->title : 'Unknown Course';
                }
            }

            $message = $addedItems > 0 ? "$addedItems item berhasil ditambahkan ke keranjang" : "Tidak ada item yang ditambahkan";
            
            if (!empty($unavailableItems)) {
                $message .= ". Item tidak tersedia: " . implode(', ', $unavailableItems);
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'added_items' => $addedItems,
                'unavailable_items' => $unavailableItems
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam memproses reorder'
            ]);
        }
    }

    /**
     * Cancel order (if still pending)
     */
    public function cancel(Order $order)
    {
        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
        }

        // Check if order can be cancelled
        if ($order->status !== 'pending' || $order->payment_status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak dapat dibatalkan'
            ]);
        }

        try {
            $order->update([
                'status' => 'cancelled',
                'payment_status' => 'cancelled'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil dibatalkan'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam membatalkan order'
            ]);
        }
    }
}
