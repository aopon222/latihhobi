<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get image URL for ecourse
     * Support both storage and public images folder
     * 
     * @param string|null $imagePath
     * @param string $fallback
     * @return string
     */
    public static function getEcourseImageUrl(?string $imagePath, string $fallback = 'placeholder-gallery-1.svg'): string
    {
        if (!$imagePath) {
            return asset('images/' . $fallback);
        }

        // If the image is stored in course_images (uploaded via admin), use Storage
        if (strpos($imagePath, 'course_images') !== false) {
            return Storage::url($imagePath);
        }

        // Otherwise, try to get from public/images folder first, then fallback to storage
        if (file_exists(public_path('images/' . $imagePath))) {
            return asset('images/' . $imagePath);
        }

        // Try storage as last resort
        if (Storage::exists($imagePath)) {
            return Storage::url($imagePath);
        }

        // Return fallback
        return asset('images/' . $fallback);
    }
}
