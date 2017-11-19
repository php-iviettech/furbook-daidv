<?php

namespace Furbook;

use Illuminate\Database\Eloquent\Model;
use Furbook\Helpers\Common;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Cat extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $fillable = ['name', 'date_of_birth', 'price', 'breed_id', 'user_id'];

    /**
     * @return array
     */
    public function breed()
    {
        return $this->belongsTo('Furbook\Breed');
    }

    public function setPriceAttribute($price)
    {
        $this->attributes['price'] = Common::convertDecimal($price);
    }

    public function getPriceAttribute()
    {
        return Common::formatCurrency($this->attributes['price']);
    }

}
