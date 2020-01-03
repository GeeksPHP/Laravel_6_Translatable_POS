<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $guarded = ['id'];

    public $translatedAttributes = ['name'];


    public function govern()
    {
        return $this->belongsTo(Govern::class);

    }//end fo govern

}
