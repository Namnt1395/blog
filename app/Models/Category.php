<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['title', 'status', 'description','created_time', 'updated_time'];

    public $timestamps = false;
}
