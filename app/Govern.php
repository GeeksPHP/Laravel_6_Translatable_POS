<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Govern extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name'];
    public function region()
    {
        return $this->belongsTo(Region::class);

    }//end fo region

    public function zones()
    {
        return $this->hasMany(Zone::class);

    }//end of zones

}//end of model
