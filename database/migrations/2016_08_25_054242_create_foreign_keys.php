<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('sheets', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('composer_id')
                ->references('id')->on('composers')
                ->onDelete('cascade');
            $table->foreign('voicing_id')
                ->references('id')->on('voicings')
                ->onDelete('cascade');
            $table->foreign('accompaniment_id')
                ->references('id')->on('accompaniments')
                ->onDelete('cascade');
            $table->foreign('publisher_id')
                ->references('id')->on('publishers')
                ->onDelete('cascade');
            $table->foreign('legal_table_id')
                ->references('id')->on('legal_tables')
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
    }
}

