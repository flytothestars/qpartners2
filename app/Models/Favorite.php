<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'id';


    public function product()
    {
        return $this->hasOne('App\Models\Product', 'product_id', 'item_id');
    }

}
