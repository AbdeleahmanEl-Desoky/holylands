<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Livewire\Site\Home::class)->name('home');
Route::get('/room', \App\Http\Livewire\Site\Room::class)->name('room');

Route::get('/news/{id}', \App\Http\Livewire\Site\News\NewsSingle::class)->name('news-single');
Route::get('/privacy-policy', \App\Http\Livewire\Site\Policy::class)->name('privacy-policy');

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Http\Livewire\Site\Auth\Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::any('/logout', \App\Http\Livewire\Site\Auth\Login::class)->name('logout');
});


Route::prefix('admin')->group(function () {

    Route::get('/login', \App\Http\Livewire\Admin\Login::class)->name('admin.login');
    Route::any('/logout', \App\Http\Livewire\Admin\Login::class)->name('admin.logout');


    Route::middleware(['auth','role:Admin'])->group(function () {

        Route::get('/', \App\Http\Livewire\Admin\Home::class)->name('admin.home');
        Route::get('/settings', \App\Http\Livewire\Admin\Settings::class)->middleware('permission:settings show')->name('admin.settings');

        Route::prefix('managers')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Managers\Managers::class)->middleware('permission:managers show')->name('admin.managers');
        });

        Route::prefix('coaches')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Coaches\Coaches::class)->middleware('permission:coaches show')->name('admin.coaches');
        });

        Route::prefix('coaches-reports')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Reports\ReportsCoach::class)->middleware('permission:reports show')->name('admin.coaches-reports');
            // Route::get('/history', \App\Http\Livewire\Admin\Reports\StudentsHistory::class)->middleware('permission:reports show')->name(name: 'admin.coaches-history');
            Route::get('/print', \App\Http\Livewire\Admin\Reports\PrintCoach::class)->middleware('permission:reports print')->name('admin.coaches-print');
        });

        Route::prefix('students')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Students\Students::class)->middleware('permission:students show')->name('admin.students');
            Route::get('/export', [\App\Http\Livewire\Admin\Students\Students::class, 'export'])->name('students.export');
        });

        Route::prefix('students-reports')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Reports\ReportsUser::class)->middleware('permission:reports show')->name('admin.students-reports');
            Route::get('/history', \App\Http\Livewire\Admin\Reports\StudentsHistory::class)->middleware('permission:reports show')->name(name: 'admin.students-history');
            Route::get('/print', \App\Http\Livewire\Admin\Reports\PrintUser::class)->middleware('permission:reports print')->name('admin.students-print');
        });

        Route::prefix('roles')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Roles\Roles::class)->middleware('permission:roles show')->name('admin.roles');
        });

        Route::prefix('levels')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Levels\Levels::class)->middleware('permission:levels show')->name('admin.levels');
        });

        Route::prefix('horses')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Horses\Horses::class)->middleware('permission:horses show')->name('admin.horses');
        });

        Route::prefix('lessons')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Lessons\Lessons::class)->middleware('permission:lessons show')->name('admin.lessons');
            Route::get('lesson/{id}', \App\Http\Livewire\Admin\Lessons\LessonsShow::class)->middleware('permission:lessons show')->name('admin.lessons.show');
        });

        Route::prefix('reports')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Reports\Reports::class)->middleware('permission:reports show')->name('admin.reports');
        });

        Route::prefix('posts')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Posts\Posts::class)->middleware('permission:posts show')->name('admin.posts');
        });

        Route::prefix('pages')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Pages\Pages::class)->middleware('permission:pages show')->name('admin.pages');
        });

        Route::prefix('contacts')->group(function () {
            Route::get('/', \App\Http\Livewire\Admin\Contacts::class)->middleware('permission:contacts show')->name('admin.contacts');
        });


    });
});


