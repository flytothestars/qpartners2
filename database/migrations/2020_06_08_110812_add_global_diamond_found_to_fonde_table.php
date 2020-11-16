<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGlobalDiamondFoundToFondeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fond = new \App\Models\Fond();
        $fond->fond_id = 4;
        $fond->fond_name_ru = 'Global Diamond Found';
        $fond->created_at = date('Y-m-d H:m:i');
        $fond->updated_at = date('Y-m-d H:m:i');
        $fond->fond_money = 0;
        $fond->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
