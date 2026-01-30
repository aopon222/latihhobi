<?php

use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getEcourseImageUrl')) {
    /**
     * Get image URL for ecourse, supporting both storage and public images
     * 
     * @param string|null $imagePath
     * @param string $fallback
     * @return string
     */
    function getEcourseImageUrl(?string $imagePath, string $fallback = 'placeholder-gallery-1.svg'): string
    {
        return ImageHelper::getEcourseImageUrl($imagePath, $fallback);
    }
}
