<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use Notifiable;
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
        'Google2fa',
        '_tokenExpiry',
    ];
    protected $hidden = [
        'Password',
        '_token',
        'Google2fa',
        '_tokenExpiry',
    ];
}
