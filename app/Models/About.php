<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class About extends Model
{
    protected $table = 'about';
    protected $primaryKey = 'about_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const GUIDE = 'guide';
    const ADMINISTRATION = 'administration';
    const ADMINISTRATION_PERSONS = 'administration_persons';
    const LEADERSHIP_ADVICE = 'leadership_advice';
    const LEADER_PERSONS = 'leader_persons';

}
