<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'image', 'created_at', 'updated_at', 'is_show'];
}
