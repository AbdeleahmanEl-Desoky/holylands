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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('job')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('affiliation_date')->nullable();
            $table->string('address')->nullable();
            $table->string('blood_type')->nullable();
            $table->longText('url_facebook')->nullable();
            $table->bigInteger('lesson_count')->default(0)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('level_id')->nullable()->index();
            $table->string('api_token')->nullable();
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
