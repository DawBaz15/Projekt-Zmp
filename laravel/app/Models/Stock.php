<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'stock';
    protected $fillable = [
        'ProductID',
        'Amount',
        'Location',
        'Date',
    ];
}
