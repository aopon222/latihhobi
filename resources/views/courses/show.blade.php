@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
             Course Image 
            <div class="mb-4">
                <img src="{{ $course->image ?: '/placeholder.svg?height=400&width=600' }}" 
                     class="img-fluid rounded" alt="{{ $course->title }}" style="width: 100%; height: 400px; object-fit: cover;">
            </div>

             Course Details 
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary fs-6">{{ $course->category }}</span>
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $course->rating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                            <span class="ms-2 text-muted">({{ $course->total_reviews }} reviews)</span>
                        </div>
                    </div>

                    <h1 class="display-6 fw-bold mb-3">{{ $course->title }}</h1>
                    <p class="lead text-muted mb-4">{{ $course->description }}</p>

                     Course Features 
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-clock text-primary me-2"></i>Duration: {{ $course->duration ?? '8 weeks' }}</li>
                                <li class="mb-2"><i class="fas fa-signal text-primary me-2"></i>Level: {{ $course->level ?? 'Beginner' }}</li>
                                <li class="mb-2"><i class="fas fa-users text-primary me-2"></i>Students: {{ $course->students_count ?? '1,234' }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-play-circle text-primary me-2"></i>Lessons: {{ $course->lessons_count ?? '24' }}</li>
                                <li class="mb-2"><i class="fas fa-certificate text-primary me-2"></i>Certificate: Yes</li>
                                <li class="mb-2"><i class="fas fa-mobile-alt text-primary me-2"></i>Mobile Access: Yes</li>
                            </ul>
                        </div>
                    </div>

                     What You'll Learn 
                    <div class="mb-4">
                        <h3 class="h4 mb-3">What You'll Learn</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Master the fundamentals</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Build real-world projects</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Industry best practices</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Advanced techniques</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Portfolio development</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Career guidance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         Sidebar 
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-body text-center">
                    <h3 class="text-primary mb-3">{{ $course->formatted_price }}</h3>
                    
                    @auth
                        @if($inCart)
                            <button class="btn btn-success btn-lg w-100 mb-3" disabled>
                                <i class="fas fa-check me-2"></i>Already in Cart
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-primary w-100 mb-3">
                                <i class="fas fa-shopping-cart me-2"></i>View Cart
                            </a>
                        @else
                            <button class="btn btn-primary btn-lg w-100 mb-3 add-to-cart-btn" data-course-id="{{ $course->id }}">
                                <i class="fas fa-cart-plus me-2"></i>Add to Cart
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Login to Purchase
                        </a>
                    @endauth

                    <div class="text-start">
                        <h5 class="mb-3">This course includes:</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-video text-primary me-2"></i>24 hours video content</li>
                            <li class="mb-2"><i class="fas fa-file-alt text-primary me-2"></i>Downloadable resources</li>
                            <li class="mb-2"><i class="fas fa-infinity text-primary me-2"></i>Lifetime access</li>
                            <li class="mb-2"><i class="fas fa-mobile-alt text-primary me-2"></i>Mobile and desktop access</li>
                            <li class="mb-2"><i class="fas fa-certificate text-primary me-2"></i>Certificate of completion</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

     Related Courses 
    @if($relatedCourses->count() > 0)
        <div class="mt-5">
            <h3 class="mb-4">Related Courses</h3>
            <div class="row">
                @foreach($relatedCourses as $relatedCourse)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ $relatedCourse->image ?: '/placeholder.svg?height=200&width=300' }}" 
                                 class="card-img-top" alt="{{ $relatedCourse->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-primary mb-2 align-self-start">{{ $relatedCourse->category }}</span>
                                <h6 class="card-title">{{ $relatedCourse->title }}</h6>
                                <p class="card-text text-muted small flex-grow-1">{{ Str::limit($relatedCourse->description, 80) }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="rating small">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $relatedCourse->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="fw-bold text-primary">{{ $relatedCourse->formatted_price }}</span>
                                </div>
                                
                                <a href="{{ route('courses.show', $relatedCourse->id) }}" class="btn btn-outline-primary btn-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Add to cart functionality
    $('.add-to-cart-btn').on('click', function() {
        const courseId = $(this).data('course-id');
        const button = $(this);
        
        button.prop('disabled', true);
        
        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                course_id: courseId,
                quantity: 1,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Update cart count
                    $('#cart-count').text(response.cart_count);
                    
                    // Show success message
                    showAlert('success', response.message);
                    
                    // Change button state
                    button.html('<i class="fas fa-check me-2"></i>Added to Cart')
                          .removeClass('btn-primary')
                          .addClass('btn-success');
                    
                    // Add view cart button
                    button.after('<a href="{{ route("cart.index") }}" class="btn btn-outline-primary w-100 mt-2"><i class="fas fa-shopping-cart me-2"></i>View Cart</a>');
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function() {
                showAlert('danger', 'Terjadi kesalahan. Silakan coba lagi.');
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });
});

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('.container').first().prepend(alertHtml);
    
    // Auto dismiss after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
}
</script>
@endpush