<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'is_show', 'image', 'created_at', 'updated_at'];


    const ELIXIR = 1;
    const GEL = 2;
    const SPRAY = 3;
    const CREAM = 4;
    const NATURAL_TEA = 5;

    public function Product()
    {
        return $this->hasMany('Product', 'category_id');
    }
}
