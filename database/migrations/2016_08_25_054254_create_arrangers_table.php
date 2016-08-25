<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrangersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('arrangers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('arranger');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('sheets', function ($table) {
            $table->foreign('arranger_id')
                ->references('id')->on('arrangers')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('arrangers');
    }
}

