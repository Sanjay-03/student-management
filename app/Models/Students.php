<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Students extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'student_details';
    protected $timestamp = false;
    protected $fillable = [
        'name',
        'address',
        'class',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];
}
