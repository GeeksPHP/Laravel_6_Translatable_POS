<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Client extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name','address'];

    protected $casts = [
        'phone' => 'array'
    ];

    // public function getNameAttribute($value)
    // {
    //     return ucfirst($value);

    // }//end of get name attribute

    public function orders()
    {
        return $this->hasMany(Order::class);

    }//end of orders


}//end of model
