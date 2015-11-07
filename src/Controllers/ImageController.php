<?php

namespace Poznet\Image\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\Controller;
use Poznet\Image\Helpers\Media;
use Intervention\Image\Constraint;


class ImageController extends Controller
{

    /**
     * @param $path
     * @param Media $media
     * @return mixed
     */
    public function get($path, Media $media)
    {
        $img = Image::make($media->getImage($path));
        return $img->response();
    }

    /**
     * @param $width
     * @param $path
     * @param Media $media
     * @return mixed
     */
    public function getMin($width, $path, Media $media)
    {
        $img = Image::make($media->getImage($path));
        $img->resize($width, null, function (Constraint $constraint) {
            $constraint->aspectRatio();
        });
        Cache::add('img-' . $width . '-' . $path, $img->response(), 60);


        return Cache::get('img-' . $width . '-' . $path);


    }

}
