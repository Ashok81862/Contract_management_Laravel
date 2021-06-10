<?php

namespace App\Services;

use App\Models\Media;

use Illuminate\Support\Str;

class MediaService {
    /**
     * Upload Service for All Models
     *
     * @param $file
     * @param string $folder
     * @param string $name
     * @param false $thumbnail_required
     * @param bool $public
     * @return false|int
     */

    public static function upload($file, $folder="uploads",$name="",$thumbnail_required= false, $public= true )
    {
        if(empty($name))
            $name = Str::slug($file->getClientOriginalName());

        $type = $file->getMimeType();

        $ext= $file->extension();

        $folderPath = $folder;

        if($public)
            $folderPath = "public/".$folder;

        $filePath = Str::random(10).mt_rand(1,100).".".$ext;

        $file->storeAs($folderPath, $filePath);

        $media = Media::create([
            'name'  => $name,
            'path'  => $folder."/".$filePath,
            "type"  =>  $type
        ]);

        return $media->id;

    }
}
