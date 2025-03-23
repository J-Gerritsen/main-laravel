<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Upload a single image.
     *
     * @param UploadedFile $image
     * @param string $directory
     * @return string|null
     */
    public function uploadSingle(UploadedFile $image, string $directory): ?string
    {
        $directory = trim($directory, '/');

        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

        $path = $image->storeAs($directory, $filename, 'public');

        return Storage::url($path);
    }

    /**
     * Upload multiple images.
     *
     * @param array $images
     * @param string $directory
     * @return array
     */
    public function uploadMultiple(array $images, string $directory): array
    {
        $uploadedPaths = [];

        foreach ($images as $image) {
            if ($image instanceof UploadedFile && $image->isValid()) {
                $path = $this->uploadSingle($image, $directory);
                if ($path) {
                    $uploadedPaths[] = $path;
                }
            }
        }

        return $uploadedPaths;
    }
}
