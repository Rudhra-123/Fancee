<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VimeoSettings extends Model
{
    use HasFactory;
    protected $table = 'vimeo_settings';

    protected $fillable = [
        'client_id',
        'client_secret',
        'access_token',
    ];
    
}
