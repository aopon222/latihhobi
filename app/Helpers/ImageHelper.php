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

        // If the image is stored in course_images (uploaded via admin to public disk), use Storage with public disk
        if (strpos($imagePath, 'course_images') !== false) {
            return Storage::disk('public')->url($imagePath);
        }

        // Otherwise, image is in public/images folder (old images)
        // Just return asset URL - Laravel will handle 404 if file doesn't exist
        return asset('images/' . $imagePath);
    }

    /**
     * Debug helper to check if image file exists in storage or public
     * 
     * @param string|null $imagePath
     * @return array
     */
    public static function debugImagePath(?string $imagePath): array
    {
        $result = [
            'path' => $imagePath,
            'storage_exists' => false,
            'public_exists' => false,
            'storage_path' => null,
            'public_path' => null,
            'final_url' => null,
        ];

        if (!$imagePath) {
            return $result;
        }

        // Check storage path
        $storagePath = storage_path('app/public/' . $imagePath);
        $result['storage_exists'] = file_exists($storagePath);
        $result['storage_path'] = $storagePath;

        // Check public path (for old images)
        $publicPath = public_path('images/' . $imagePath);
        $result['public_exists'] = file_exists($publicPath);
        $result['public_path'] = $publicPath;

        // Get final URL
        $result['final_url'] = self::getEcourseImageUrl($imagePath);

        return $result;
    }
}
