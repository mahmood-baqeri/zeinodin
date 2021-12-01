<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('title');
            $table->string('url')->nullable();
            $table->text('text_short');
            $table->text('text');
            $table->integer('menu_id')->default(0);
            $table->string('img')->nullable();
            $table->integer('status')->default(0);
            $table->string('date')->nullable();
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
        Schema::dropIfExists('page');
    }
}
