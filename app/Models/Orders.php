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

    public function user(){
    	return $this->hasOne('App\Models\User','id','user_id');
    }

    public function delivery_boy(){
    	return $this->hasOne('App\Models\User','id','delivery_boy_id');
    }
}
