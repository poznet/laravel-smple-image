<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile as Uploaded;

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
    private $id;

    private $imagePath = null;
    private $filePath = null;

    /**
     *
     */
    public function __construct()
    {
        $this->disk = Storage::disk('local');
    }

    /**
     * @return bool
     */
    public function check()
    {
        $exists = $this->disk->exists('strony');
        if (!$exists)
            $this->disk->makeDirectory('strony');
        return true;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
        $this->imagePath = 'strony/' . $this->id . '/img/';
        $this->filePath = 'strony/' . $this->id . '/file/';
        $this->check();
        $exists = $this->disk->exists('strony/' . $this->id);
        if (!$exists)
            $this->disk->makeDirectory('strony/' . $this->id);

        $exists = $this->disk->exists($this->imagePath);
        if (!$exists)
            $this->disk->makeDirectory($this->imagePath);

        $exists = $this->disk->exists($this->filePath);
        if (!$exists)
            $this->disk->makeDirectory($this->filePath);
    }


    public function getImage($path)
    {
        return $this->disk->get($path);
    }

    public function images()
    {
        return $this->disk->files($this->imagePath);
    }

    public function exist($path){
        return in_array($path,$this->images());
    }

    public function fileExist($file){
        return $this->disk->exists($this->imagePath.$file);
    }


    public function imagesToJson()
    {
        $data = $this->images();
        $data = array_flip($data);
        foreach ($data as &$val) {
            $val = array('podpis' => null, 'mime' => null);
        }

        return json_encode($data);
    }

    public function uploadImage(Uploaded $img)
    {
        $this->disk->put($this->imagePath . $img->getClientOriginalName(), File::get($img));
        return true;
    }

    public function delFile($path)
    {
        if ($this->disk->exists($path))
            $this->disk->delete($path);

        return true;
    }


}