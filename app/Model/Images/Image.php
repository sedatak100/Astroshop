<?php

namespace App\Model\Images;

class Image
{
    public static function resize($path, $x, $y)
    {
        if (!$path) {
            $path = 'uploads/images/products/no-image.jpg';
        }
        $dir = pathinfo($path, PATHINFO_DIRNAME);
        $image_name = basename($path);
        $new_name = $x . '_' . $y . '_' . $image_name;

        $cache_path = \Storage::disk('public')->path('cache/' . $dir . '/');
        if (!\File::exists($cache_path . $new_name)) {

            if (!\File::exists($cache_path)) {
                \File::makeDirectory($cache_path, 755, true);
            }

            $image = \Intervention\Image\Facades\Image::make(\Storage::disk('public')->path($path));
            $image->resize($x, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $image->save($cache_path . $new_name);
        }
        return \Storage::disk('cache')->url($dir . '/' . $new_name);
    }
}
