<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function GuzzleHttp\describe_type;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description'];
}
