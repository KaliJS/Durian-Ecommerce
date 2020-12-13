<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryManagement extends Model
{
    use HasFactory;
    protected $table = 'delivery_management';
    public $timestamps = false;
}
