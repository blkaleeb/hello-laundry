<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    // Table Outlets
    protected $fillable = [
        'nama', 'alamat', 'hotline', 'email', 'iframe_script'
    ];
}
