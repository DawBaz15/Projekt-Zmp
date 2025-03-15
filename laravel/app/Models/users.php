<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'ID',
        'Email',
        'Phone',
        'Name',
        'Surname',
        'Password',
        'AccountDate',
        'IsAdmin',
        'AccountActive',
        '_token',
    ];

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    public function getAuthIdentifier()
    {
        return $this->Email;
    }

    public function getAuthEmail()
    {
        return $this->Email;
    }

    public function getAuthPassword()
    {
        //return Hash::make($this->Password);
        return $this->Password;
    }

}
