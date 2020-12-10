<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	use HasFactory;

    protected $table = 'orders';

    protected $guarded = ['id'];

    public function items(){
    	return $this->hasMany('App\Models\OrderItems','order_id','id');
    }
}
