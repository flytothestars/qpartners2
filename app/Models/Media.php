<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;


class Media extends BasicModel
{
    use SoftDeletes;

    /**
     * Media constructor.
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
        $this->name = $this->name ?: 'not_found.jpg';
    }

    public static $TYPE_PHOTO = 'photo';
    public static $TYPE_VIDEO = 'video';
    
    protected $table = 'media';

    public $fillable = ['type', 'filename', 'original_name'];

    public $dates = ['deleted_at'];

    public function prefixLink($prefix, $width = null, $height = null) {
        return $this->link($width, $height);
    }

    public function link($width = null, $height = null) {
        $attr = ['fileName' => $this->name];
        if($width != null) {
            $attr['width'] = $width;
        }
        if($height != null) {
            $attr['height'] = $height;
        }
        return action('MediaController@image', $attr);
    }

    public function gridLink($width = null, $height = null) {

        $attr = ['fileName' => $width.'x'.$height.'_'.$this->name];

        return action('MediaController@image', $attr);
    }


    public function rename($newName) {

        $imagesPath = storage_path('app/images/original/');

        $currentFile = $imagesPath . $this->name;

        $extension = pathinfo($currentFile, PATHINFO_EXTENSION);

        if(file_exists($currentFile)) {
            for ($i = 1; $i < 1000; $i++) {
                $newFilename = $newName . '-' . $i . '.' . $extension;
                $newFile = $imagesPath . $newFilename;

                if (!file_exists($newFile)) {
                    if(copy($currentFile, $newFile)) {
                        $this->name = $newFilename;
                        $this->update();
                        return unlink($currentFile);
                    }
                }
            }
        }

        return false;
    }

}
