<?php

namespace Furbook;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function imagetable()
    {
        return $this->morphTo();
    }
}
