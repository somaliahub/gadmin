<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class SimpleNotice extends Model
{
    public function getTypeAttribute($type)
    {
        if (is_string($type)) {
            return json_decode($type, true);
        }

        return $type;
    }

    public function setTypeAttribute($type)
    {
        if (is_array($type)) {
            $this->attributes['type'] = json_encode($type);
        }
    }
}
