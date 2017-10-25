<?php

namespace Furbook;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function images()
    {
        return $this->morphMany('Furbook\Image', 'imagetable');
    }
}
