<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $table = 'admins'; // Specify the table name if it's not 'admins'
    protected $fillable = [
        'name', 'email', 'password', // Add other fillable fields as needed
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
