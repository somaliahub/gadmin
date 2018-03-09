<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public function setCoverAttribute($cover)
    {
        $this->attributes['cover'] = json_encode($cover);
    }

    public function getCoverAttribute($cover)
    {
        return json_decode($cover, true);
    }

    public function getTagAttribute($tag)
    {
        if (is_string($tag)) {
            return json_decode($tag, true);
        }

        return $tag;
    }

    public function setTagAttribute($tag)
    {
        if (is_array($tag)) {
            $this->attributes['tag'] = json_encode($tag);
        }
    }
}
