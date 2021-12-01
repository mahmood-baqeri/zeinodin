<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('slider', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('title')->nullable();
            $table->string('text')->nullable();
            $table->string('url')->nullable();
            $table->integer('show');
            $table->integer('status');
            $table->string('file')->nullable();
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
        Schema::table('slider', function (Blueprint $table) {
            //
        });
    }
}
