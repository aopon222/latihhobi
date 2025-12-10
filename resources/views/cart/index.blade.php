@extends('layout.app')

@section('title', 'Keranjang Saya - LatihHobi')

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
                            <div class="row align-items-center border-bottom py-3" data-cart-id="{{ $item->id_cart_items }}">
                                <div class="col-md-2">
                                    <img src="{{ optional($item->course)->image_url ?: '/placeholder.svg' }}" 
                                         class="img-fluid rounded" alt="{{ optional($item->course)->name }}">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="mb-1">{{ optional($item->course)->name ?? 'Product' }}</h5>
                                    <p class="text-muted mb-1">{{ optional(optional($item->course)->category)->name ?? '' }}</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="decrease" data-cart-id="{{ $item->id_cart_items }}">-</button>
                                        <input type="number" class="form-control form-control-sm text-center quantity-input" 
                                               value="{{ $item->quantity }}" min="1" max="10" data-cart-id="{{ $item->id_cart_items }}">
                                        <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="increase" data-cart-id="{{ $item->id_cart_items }}">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <span class="fw-bold text-primary item-price">{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-outline-danger btn-sm remove-item-btn" data-cart-id="{{ $item->id_cart_items }}">
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
                    <a href="{{ route('ecourse.index') }}" class="btn btn-outline-primary">
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
                            <span id="subtotal">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span>
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
                            <strong id="total-amount" class="text-primary">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</strong>
                        </div>
                        
                        <a href="{{ url('/checkout') }}" class="btn btn-primary btn-lg w-100">
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
            <a href="{{ route('ecourse.index') }}" class="btn btn-primary btn-lg">
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
    // format numbers as Indonesian Rupiah
    try {
        const sub = Number(response.subtotal) || 0;
        const total = Number(response.total) || 0;
        $('#subtotal').text('Rp ' + Math.round(sub).toLocaleString('id-ID'));
        $('#total-amount').text('Rp ' + Math.round(total).toLocaleString('id-ID'));
    } catch (e) {
        $('#subtotal').text(response.subtotal);
        $('#total-amount').text(response.total);
    }
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
