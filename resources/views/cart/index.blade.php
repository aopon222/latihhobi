@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="display-5 fw-bold mb-4">Shopping Cart</h1>
        </div>
    </div>

    @if($cartItems->count() > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($cartItems as $item)
                            <div class="row align-items-center border-bottom py-3" data-cart-id="{{ $item->id }}">
                                <div class="col-md-2">
                                    <img src="{{ $item->course->image ?: '/placeholder.svg?height=100&width=150' }}" 
                                         class="img-fluid rounded" alt="{{ $item->course->title }}">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="mb-1">{{ $item->course->title }}</h5>
                                    <p class="text-muted mb-1">{{ $item->course->category }}</p>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $item->course->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        <small class="text-muted ms-1">({{ $item->course->total_reviews }})</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="decrease" data-cart-id="{{ $item->id }}">-</button>
                                        <input type="number" class="form-control form-control-sm text-center quantity-input" 
                                               value="{{ $item->quantity }}" min="1" max="10" data-cart-id="{{ $item->id }}">
                                        <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="increase" data-cart-id="{{ $item->id }}">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <span class="fw-bold text-primary item-price">{{ $item->course->formatted_price }}</span>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-outline-danger btn-sm remove-item-btn" data-cart-id="{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-outline-danger" id="clear-cart-btn">
                        <i class="fas fa-trash me-2"></i>Clear Cart
                    </button>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal (<span id="total-items">{{ $cartItems->sum('quantity') }}</span> items):</span>
                            <span id="subtotal">{{ $total }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <span id="tax">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping:</span>
                            <span id="shipping" class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="total-amount" class="text-primary">{{ $total }}</strong>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h3>Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any courses to your cart yet.</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-search me-2"></i>Browse Courses
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Quantity change handlers
    $('.quantity-btn').on('click', function() {
        const action = $(this).data('action');
        const cartId = $(this).data('cart-id');
        const input = $(`.quantity-input[data-cart-id="${cartId}"]`);
        let quantity = parseInt(input.val());
        
        if (action === 'increase') {
            quantity = Math.min(quantity + 1, 10);
        } else {
            quantity = Math.max(quantity - 1, 1);
        }
        
        input.val(quantity);
        updateCartItem(cartId, quantity);
    });

    $('.quantity-input').on('change', function() {
        const cartId = $(this).data('cart-id');
        let quantity = parseInt($(this).val());
        quantity = Math.max(1, Math.min(quantity, 10));
        $(this).val(quantity);
        updateCartItem(cartId, quantity);
    });

    // Remove item
    $('.remove-item-btn').on('click', function() {
        const cartId = $(this).data('cart-id');
        removeCartItem(cartId);
    });

    // Clear cart
    $('#clear-cart-btn').on('click', function() {
        if (confirm('Are you sure you want to clear your cart?')) {
            clearCart();
        }
    });
});

function updateCartItem(cartId, quantity) {
    $.ajax({
        url: `/cart/update/${cartId}`,
        method: 'PATCH',
        data: {
            quantity: quantity,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                updateCartSummary(response);
                showAlert('success', 'Cart updated successfully');
            } else {
                showAlert('danger', response.message);
            }
        },
        error: function() {
            showAlert('danger', 'Failed to update cart');
        }
    });
}

function removeCartItem(cartId) {
    $.ajax({
        url: `/cart/remove/${cartId}`,
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                $(`[data-cart-id="${cartId}"]`).fadeOut(300, function() {
                    $(this).remove();
                    if ($('.card-body .row').length === 0) {
                        location.reload();
                    }
                });
                updateCartSummary(response);
                $('#cart-count').text(response.cart_count);
                showAlert('success', 'Item removed from cart');
            } else {
                showAlert('danger', response.message);
            }
        },
        error: function() {
            showAlert('danger', 'Failed to remove item');
        }
    });
}

function clearCart() {
    $.ajax({
        url: '{{ route("cart.clear") }}',
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                location.reload();
            } else {
                showAlert('danger', response.message);
            }
        },
        error: function() {
            showAlert('danger', 'Failed to clear cart');
        }
    });
}

function updateCartSummary(response) {
    $('#total-items').text(response.total_items);
    $('#subtotal').text(response.subtotal);
    $('#total-amount').text(response.total);
}

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('.container').first().prepend(alertHtml);
    
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
}
</script>
@endpush
