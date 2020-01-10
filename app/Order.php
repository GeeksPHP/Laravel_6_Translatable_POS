<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Sqits\UserStamps\Concerns\HasUserStamps;

class Order extends Model
{
    //   use HasUserStamps;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);

    }//end of user

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity');

    }//end of products

}//end of model
