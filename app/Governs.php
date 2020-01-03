<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Govern extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $guarded = ['id'];

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
