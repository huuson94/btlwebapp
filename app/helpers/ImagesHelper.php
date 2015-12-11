<?php

class ImagesHelper{
    public static function save($data, $id = null) {
        if ($id != null) {
            $image = Image::find($id);
        } else {
            $image = new Image;
        }
        $image->path = $data['path'];
        $image->album_id = $data['album_id'];
        $image->caption = $data['caption'];
        $image->post_id = $data['post_id'];
        $image->count_like = 0;
        if($image->save()) return $image;
    }

}