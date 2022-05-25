<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gadget_id');
            $table->integer('day_of_week'); // DateTime->dayOfWeek => Sunday: 0, Monday: 1, ...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_needs');
    }
}
