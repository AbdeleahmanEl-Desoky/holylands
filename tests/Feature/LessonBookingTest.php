<?php

namespace Tests\Feature;

use App\Actions\Lessons\BookLessonAction;
use App\DTOs\Lessons\BookLessonDto;
use App\Models\Lesson;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserLesson;
use App\Services\FCM\FCMService;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\Sanctum;
use Mockery;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LessonBookingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->integer('lesson_count')->default(2);
            $table->string('fcm_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        foreach ([
            '2023_02_21_132700_create_permission_tables.php',
            '2023_02_26_040403_create_lessons_table.php',
            '2023_03_02_013544_create_user_lessons_table.php',
            '2021_03_27_192025_create_notifications_table.php',
        ] as $file) {
            $migration = require_once database_path('migrations/' . $file);
            if ($file === '2023_02_21_132700_create_permission_tables.php') {
                $migration = new \CreatePermissionTables();
            } elseif ($file === '2021_03_27_192025_create_notifications_table.php') {
                $migration = new \CreateNotificationsTable();
            } elseif (!is_object($migration)) {
                $migration = require database_path('migrations/' . $file);
            }
            $migration->up();
        }
        $this->uniqueMigration()->up();
        Role::create(['name' => 'Student', 'guard_name' => 'web']);
        $this->app->instance(FCMService::class, Mockery::mock(FCMService::class)->shouldIgnoreMissing());
    }

    private function uniqueMigration()
    {
        return require database_path('migrations/2026_11_10_000001_enforce_unique_student_lesson_booking.php');
    }

    private function fixtures(): array
    {
        $coach = User::create(['name' => 'Coach', 'fcm_token' => 'test-token']);
        $student = User::create(['name' => 'Student', 'coach_id' => $coach->id, 'lesson_count' => 2]);
        $student->assignRole('Student');
        $lesson = Lesson::create(['coach_id' => $coach->id, 'level_id' => 1, 'number_hours' => 60, 'number_students' => 1]);
        return [$student, $lesson];
    }

    private function book(User $student, Lesson $lesson): array
    {
        return app(BookLessonAction::class)->execute(new BookLessonDto($student->id, $lesson->id));
    }

    public function test_repeated_endpoint_requests_create_one_booking_and_one_notification(): void
    {
        [$student, $lesson] = $this->fixtures();
        $fcm = Mockery::mock(FCMService::class);
        $fcm->shouldReceive('sendNotification')->once()->andReturnUsing(function () {
            $this->assertSame(0, DB::transactionLevel());
            $this->assertSame(1, UserLesson::count());
        });
        $this->app->instance(FCMService::class, $fcm);
        Sanctum::actingAs($student);
        $this->postJson('/api/booking/' . $lesson->id)->assertOk()->assertJsonPath('status', true);
        $deadline = UserLesson::first()->time_end;
        $this->postJson('/api/booking/' . $lesson->id)->assertOk()->assertJsonPath('status', false);
        $this->assertSame(1, UserLesson::count());
        $this->assertSame(1, Notification::count());
        $this->assertSame($deadline, UserLesson::first()->time_end);
    }

    public function test_full_lesson_and_exhausted_balance_are_rejected(): void
    {
        [$student, $lesson] = $this->fixtures();
        $this->assertTrue($this->book($student, $lesson)['status']);
        $other = User::create(['name' => 'Other', 'coach_id' => $student->coach_id, 'lesson_count' => 2]);
        $other->assignRole('Student');
        $this->assertFalse($this->book($other, $lesson)['status']);
        $student->update(['lesson_count' => 1]);
        $anotherLesson = $lesson->replicate();
        $anotherLesson->save();
        $this->assertFalse($this->book($student, $anotherLesson)['status']);
        $this->assertSame(1, UserLesson::count());
    }

    public function test_repeated_student_requests_are_rejected_without_the_unique_index(): void
    {
        $this->uniqueMigration()->down();
        [$student, $lesson] = $this->fixtures();
        $student->update(['lesson_count' => 20]);
        $lesson->update(['number_students' => 20]);
        $fcm = Mockery::mock(FCMService::class);
        $fcm->shouldReceive('sendNotification')->once();
        $this->app->instance(FCMService::class, $fcm);
        Sanctum::actingAs($student);

        $this->postJson('/api/booking/' . $lesson->id)->assertOk()->assertJsonPath('status', true);
        $booking = UserLesson::first()->getAttributes();
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->postJson('/api/booking/' . $lesson->id)
                ->assertOk()
                ->assertJsonPath('status', false)
                ->assertJsonPath('message', 'عذرا , لايمكن حجز الدرس مرتين');
        }

        $this->assertSame(1, UserLesson::count());
        $this->assertSame(1, Notification::count());
        $this->assertSame($booking, UserLesson::first()->getAttributes());
    }

    public function test_historical_duplicates_do_not_allow_another_student_booking(): void
    {
        $this->uniqueMigration()->down();
        [$student, $lesson] = $this->fixtures();
        $this->book($student, $lesson);
        UserLesson::first()->replicate()->save();
        $fcm = Mockery::mock(FCMService::class);
        $fcm->shouldNotReceive('sendNotification');
        $this->app->instance(FCMService::class, $fcm);
        Sanctum::actingAs($student);

        $this->postJson('/api/booking/' . $lesson->id)
            ->assertOk()
            ->assertJsonPath('status', false)
            ->assertJsonPath('message', 'عذرا , لايمكن حجز الدرس مرتين');

        $this->assertSame(2, UserLesson::count());
        $this->assertSame(1, Notification::count());
    }

    public function test_missing_lesson_wrong_coach_and_non_student_are_rejected(): void
    {
        [$student, $lesson] = $this->fixtures();
        $this->assertFalse(app(BookLessonAction::class)->execute(new BookLessonDto($student->id, 999))['status']);
        $lesson->update(['coach_id' => 999]);
        $this->assertFalse($this->book($student, $lesson)['status']);
        $student->syncRoles([]);
        $this->assertFalse($this->book($student, $lesson)['status']);
        $this->assertSame(0, UserLesson::count());
        $this->assertSame(0, Notification::count());
    }

    public function test_push_failure_does_not_undo_or_repeat_a_saved_booking(): void
    {
        [$student, $lesson] = $this->fixtures();
        $fcm = Mockery::mock(FCMService::class);
        $fcm->shouldReceive('sendNotification')->once()->andThrow(new \RuntimeException('Unavailable'));
        $this->app->instance(FCMService::class, $fcm);
        $this->assertTrue($this->book($student, $lesson)['status']);
        $this->assertFalse($this->book($student, $lesson)['status']);
        $this->assertSame(1, UserLesson::count());
    }

    public function test_database_rejects_duplicate_even_when_action_is_bypassed(): void
    {
        [$student, $lesson] = $this->fixtures();
        $this->book($student, $lesson);
        $this->expectException(QueryException::class);
        UserLesson::first()->replicate()->save();
    }

    public function test_notification_persistence_failure_rolls_back_booking(): void
    {
        [$student, $lesson] = $this->fixtures();
        $fcm = Mockery::mock(FCMService::class);
        $fcm->shouldNotReceive('sendNotification');
        $this->app->instance(FCMService::class, $fcm);
        Notification::creating(function () {
            throw new \RuntimeException('Notification persistence failed');
        });
        try {
            $this->book($student, $lesson);
            $this->fail('Expected persistence failure.');
        } catch (\RuntimeException $exception) {
            $this->assertSame('Notification persistence failed', $exception->getMessage());
        } finally {
            Notification::flushEventListeners();
        }
        $this->assertSame(0, UserLesson::count());
        $this->assertSame(0, Notification::count());
    }

    public function test_booking_requires_authentication(): void
    {
        $this->postJson('/api/booking/1')->assertUnauthorized();
    }

    public function test_migration_preserves_existing_duplicates_and_can_be_reversed(): void
    {
        [$student, $lesson] = $this->fixtures();
        $this->book($student, $lesson);
        $this->uniqueMigration()->down();
        UserLesson::first()->replicate()->save();
        try {
            $this->uniqueMigration()->up();
            $this->fail('Expected duplicate preflight to stop migration.');
        } catch (\RuntimeException $exception) {
            $this->assertStringContainsString('Duplicate student lesson bookings', $exception->getMessage());
        }
        $this->assertSame(2, UserLesson::count());
    }
}
