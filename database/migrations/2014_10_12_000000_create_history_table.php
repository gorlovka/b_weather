<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history',
              function (Blueprint $table)
        {
            $table->integer('id')->autoIncrement();
            $table->float('temp');
            $table->date('date_at')->index();
        });


        DB::statement('ALTER TABLE `history` CHANGE `temp` `temp` FLOAT NOT NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }

}
