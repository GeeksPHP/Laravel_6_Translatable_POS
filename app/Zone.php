<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Sqits\UserStamps\Concerns\HasUserStamps;

class Zone extends Model
{
      use Translatable;
     //  use HasUserStamps;

    protected $guarded = [];
    public $translatedAttributes = ['name'];


    public function govern()
    {
        return $this->belongsTo(Govern::class);

    }//end fo govern

}
