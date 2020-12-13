<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
	use HasFactory;
	
    protected $table = 'order_items';

    protected $guarded = ['id'];

    public function items(){
    	return $this->hasMany('App\Models\OrderItems','order_id','id');
    }

    public function product_variant(){
        return $this->hasOne('App\Models\ProductVariants','id','product_variant_id');
    }
}
