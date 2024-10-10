<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lesson_id')->nullable();
            $table->bigInteger('level_id')->nullable()->index();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('coach_id')->nullable();
            $table->bigInteger('number_hours')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->timestamp('time_end');
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
        Schema::dropIfExists('user_lessons');
    }
};
