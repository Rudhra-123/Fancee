<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VimeoUri extends Model
{
    use HasFactory;


    protected $fillable = ['uri', 'order_id'];
}
