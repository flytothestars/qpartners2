<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqStatuses extends Model
{
    protected $table = 'faq_statuses';
    protected $primaryKey = 'id';

    const IN_PROCESS = 1; // на рассмотрение
    const FINISHED = 2; // завершен
    const WAITING = 3; // в ожидании
    const CONFIRMED = 4; // принято
    const  CANCELED = 5; // отказано

}
