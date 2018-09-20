<?php

namespace App\Listeners;

use App\Events\ProductAddedEdited;
use App\Model\Images\Image;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductImageResize
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductAddedEdited $event
     * @return void
     */
    public function handle(ProductAddedEdited $event)
    {
        $image_resizes = config('product_image') ?? [];
        foreach ($image_resizes as $image_resize) {
            $x = $image_resize['x'];
            $y = $image_resize['y'];
            Image::resize($event->product->image, $x, $y);
        }

        $event->product->images->each(function ($image) use ($event, $image_resizes) {
            foreach ($image_resizes as $image_resize) {
                $x = $image_resize['x'];
                $y = $image_resize['y'];
                Image::resize($image->image, $x, $y);
            }
        });
    }
}
