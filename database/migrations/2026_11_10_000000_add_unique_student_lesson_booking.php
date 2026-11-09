<?php

use App\Models\UserLesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Preserve existing attendance and horse assignments for manual reconciliation.
        // if (UserLesson::select('user_id', 'lesson_id')
        //     ->groupBy('user_id', 'lesson_id')->havingRaw('COUNT(*) > 1')->exists()) {
        //     throw new RuntimeException('Duplicate student lesson bookings exist. Reconcile them before adding the unique index.');
        // }

        // Schema::table('user_lessons', function (Blueprint $table) {
        //     $table->unique(['user_id', 'lesson_id'], 'user_lessons_user_lesson_unique');
        // });
    }

    public function down()
    {
        // Schema::table('user_lessons', function (Blueprint $table) {
        //     $table->dropUnique('user_lessons_user_lesson_unique');
        // });
    }
};
