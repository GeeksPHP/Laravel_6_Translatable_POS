<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Sqits\UserStamps\Concerns\HasUserStamps;

class Region extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;
   // use HasUserStamps;

    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function governs()
    {
        return $this->hasMany(Govern::class);

    }//end of governs

    //     public function user(){
    //     return $this->belongsTo('App\User');
    // }

    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::deleting(function($region) {
    //         $relationMethods = ['governs'];
    
    //         foreach ($relationMethods as $relationMethod) {
    //             if ($region->$relationMethod()->count() > 0) {
                   
    //                 return false;
    //              //  return redirect()->back()->with('success', 'Data Added successfully.');
    //             }
    //         }
    //     });
    // }


}
