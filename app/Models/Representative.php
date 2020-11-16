<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['full_name', 'city_id', 'phone_number', 'whatsapp', 'instagram', 'is_active', 'address'];


    public function city()
    {
        return $this->hasOne('App\Models\City', 'city_id');
    }
}
