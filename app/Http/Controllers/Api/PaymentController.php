<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Payment;
use App\Models\Enrollment;

class PaymentController extends Controller
{
    /**
     * Get user's payments
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 12);
        $status = $request->get('status');

        $payments = Payment::whereHas('enrollment', function ($query) use ($user) {
                $query->where('student_id', $user->id);
            })
            ->with(['enrollment.classModel.program'])
            ->when($status, function ($query) use ($status) {
                return $query->byStatus($status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $payments
        ]);
    }

    /**
     * Get a specific payment
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();

        $payment = Payment::whereHas('enrollment', function ($query) use ($user) {
                $query->where('student_id', $user->id);
            })
            ->with(['enrollment.classModel.program'])
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $payment
        ]);
    }

    /**
     * Create a new payment
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'enrollment_id' => 'required|exists:enrollments,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:bank_transfer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if enrollment belongs to user
        $enrollment = Enrollment::where('student_id', $user->id)
            ->findOrFail($request->enrollment_id);

        // Check if payment amount is valid
        $remainingAmount = $enrollment->final_price - $enrollment->paid_amount;
        if ($request->amount > $remainingAmount) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment amount exceeds remaining balance'
            ], 400);
        }

        // Create payment
        $payment = new Payment([
            'payment_number' => 'PAY-' . now()->format('Ymd') . '-' . strtoupper(uniqid()),
            'enrollment_id' => $enrollment->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        $payment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment created successfully',
            'data' => $payment->load('enrollment.classModel.program')
        ], 201);
    }

    /**
     * Upload payment proof
     */
    public function uploadProof(Request $request, $id)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $payment = Payment::whereHas('enrollment', function ($query) use ($user) {
                $query->where('student_id', $user->id);
            })
            ->findOrFail($id);

        // Store the proof image
        $proofPath = $request->file('proof')->store('payment_proofs', 'public');

        // Update payment
        $payment->proof_images = array_merge(
            $payment->proof_images ?? [],
            [$proofPath]
        );
        $payment->status = 'processing';
        $payment->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment proof uploaded successfully',
            'data' => [
                'proof_url' => asset('storage/' . $proofPath)
            ]
        ]);
    }
}