<?php

namespace Furbook;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    public $timestamps = false;

    /**
     * @return array
     */
    public function cats()
    {
        return $this->hasMany('Furbook\Cat');
    }
}
