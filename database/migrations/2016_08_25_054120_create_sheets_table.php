<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sheet_name');
            $table->string('sheet_alternative_name')->nullable();
            $table->integer('composer_id')->unsigned();
            $table->integer('arranger_id')->unsigned();
            $table->integer('voicing_id')->unsigned();
            $table->integer('accompaniment_id')->unsigned();
            $table->string('publisher_number')->nullable();
            $table->integer('publisher_id')->unsigned();
            $table->string('copyright_year')->nullable();
            $table->smallInteger('quantity')->unsigned()->nullable();
            $table->integer('legal_table_id')->unsigned();
            $table->softDeletes();
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
            Schema::drop('sheets');
        }
    }
