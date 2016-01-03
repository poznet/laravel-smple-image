<?php

namespace Poznet\Image\Helpers;


use Illuminate\Support\Facades\Storage;


/**
 * Created by PhpStorm.
 * User: pozyc
 * Date: 28.08.2015
 * Time: 23:29
 */
class Media
{
    /**
     * @var
     */
    private $disk;
    /**
     * @var
     */


    public function __construct()
    {
        $this->disk = Storage::disk('local');
        $exists = $this->disk->exists('tmp');
        if (!$exists)
            $this->disk->makeDirectory('tmp');
    }




    public function getImage($path)
    {
        return $this->disk->get($path);
    }


    public function fileExist($file){
        return $this->disk->exists($this->imagePath.$file);
    }



}