<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'Email',
        'Phone',
        'Name',
        'Surname',
        'Password',
        'AccountDate',
        'AccountActive',
        '_token',
    ];
    protected $hidden = [
        'Password',
        '_token',
    ];
}
