@extends('layouts.app')

@section('title', 'All Courses')

@section('content')
<div class="container">
     Page Header 
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5 fw-bold">All Courses</h1>
            <p class="lead text-muted">Discover our comprehensive collection of courses</p>
        </div>
    </div>

     Filters and Search 
    <div class="row mb-4">
        <div class="col-lg-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
                </div>
                <div class="card-body">
                    <form id="filter-form">
                         Category Filter 
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category" class="form-select" id="category-filter">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                         Price Range 
                        <div class="mb-3">
                            <label class="form-label fw-bold">Price Range</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" name="min_price" class="form-select" placeholder="Min" 
                                           value="{{ request('min_price') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="max_price" class="form-select" placeholder="Max" 
                                           value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                         Sort By 
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sort By</label>
                            <select name="sort" class="form-select" id="sort-filter">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>Apply Filters
                        </button>
                        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-times me-2"></i>Clear Filters
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
             Search Bar 
            <div class="row mb-3">
                <div class="col-12">
                    <form method="GET" action="{{ route('courses.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-lg" 
                                   placeholder="Search courses..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

             Results Info 
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-muted mb-0">
                    Showing {{ $courses->firstItem() ?? 0 }} - {{ $courses->lastItem() ?? 0 }} 
                    of {{ $courses->total() }} courses
                </p>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-secondary active" id="grid-view">
                        <i class="fas fa-th"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="list-view">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>

             Courses Grid 
            <div class="row" id="courses-container">
                @forelse($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4 course-item">
                        <div class="card h-100 shadow-sm course-card">
                            <img src="{{ $course->image ?: '/placeholder.svg?height=200&width=300' }}" 
                                 class="card-img-top" alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-primary mb-2 align-self-start">{{ $course->category }}</span>
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($course->description, 100) }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $course->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        <small class="text-muted ms-1">({{ $course->total_reviews }})</small>
                                    </div>
                                    <span class="h5 text-primary mb-0">{{ $course->formatted_price }}</span>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary flex-grow-1">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                    @auth
                                        <button class="btn btn-primary add-to-cart-btn" data-course-id="{{ $course->id }}">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h3>No courses found</h3>
                            <p class="text-muted">Try adjusting your search criteria or browse all courses.</p>
                            <a href="{{ route('courses.index') }}" class="btn btn-primary">
                                <i class="fas fa-refresh me-2"></i>View All Courses
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

             Pagination 
            @if($courses->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $courses->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Filter form submission
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        const currentSearch = new URLSearchParams(window.location.search).get('search');
        
        let url = '{{ route("courses.index") }}?' + formData;
        if (currentSearch) {
            url += '&search=' + encodeURIComponent(currentSearch);
        }
        
        window.location.href = url;
    });

    // View toggle
    $('#grid-view, #list-view').on('click', function() {
        $('.btn-group .btn').removeClass('active');
        $(this).addClass('active');
        
        if ($(this).attr('id') === 'list-view') {
            $('.course-item').removeClass('col-lg-4 col-md-6').addClass('col-12');
            $('.course-card').addClass('mb-3').find('.card-body').removeClass('d-flex flex-column');
        } else {
            $('.course-item').removeClass('col-12').addClass('col-lg-4 col-md-6');
            $('.course-card').removeClass('mb-3').find('.card-body').addClass('d-flex flex-column');
        }
    });

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
                    button.html('<i class="fas fa-check"></i>').removeClass('btn-primary').addClass('btn-success');
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