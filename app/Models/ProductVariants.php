<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $guarded = ['id'];

    public function unit(){
    	return $this->hasOne('App\Models\Unit','id','unit_id');
    }

}
