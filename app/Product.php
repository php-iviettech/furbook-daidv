<?php

namespace Furbook;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'name', 'price'
    ];
}
