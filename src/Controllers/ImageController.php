<?php

namespace Poznet\Image\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Poznet\Image\Helpers\Media;
use Intervention\Image\Constraint;



class ImageController extends Controller
{

    private $tmp;
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
        $this->tmp = Storage::disk('local');

        $img = Cache::remember('img-' . $width . '-' . $path, 60, function() use($width,$path,$media)
        {

            $img = Image::make($media->getImage($path));
            $img->resize($width, null, function (Constraint $constraint) {
                $constraint->aspectRatio();
            });

            $name=str_random(40).'.jpg';
            $data=$img->encode('jpg', 95);
            $this->tmp->put('tmpimage/'.$name, $data);
            $factory = new \ImageOptimizer\OptimizerFactory();
            $optimizer  = $factory->get('jpegoptim');
            $filepath = storage_path().'/app/tmpimage/'.$name;
            $optimizer->optimize($filepath);
            $img = Image::make( $this->tmp->get('tmpimage/'.$name));
            $this->tmp->delete('tmpimage/'.$name);
            return $img->response();
        });



        return $img;


    }

}
