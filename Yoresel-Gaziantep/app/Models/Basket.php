<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'baskets';
    protected $fillable =['productNumber'];
}
