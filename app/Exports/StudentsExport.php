<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserLesson;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $students = User::role('Student')->get();

        // Map the collection to return only the necessary fields
        return $students->map(function ($user) {
            $userLessonCount = UserLesson::where('user_id', $user->id)->count();
            $lessonMotabaky = $user->lesson_count - $userLessonCount;

            return [
                'name'             => $user->name,
                'username'         => $user->username,
                'email'            => $user->email,
                'mobile'           => $user->mobile,
                'lesson_motabaky'  => $lessonMotabaky,
                'status'           => User::statusList($user->status),
                'level'            =>$user->level->name,
                'coach'            =>$user?->coach?->name
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Username',
            'Email',
            'Mobile',
            'Remaining Lessons',
            'Status',
            'Level'
        ];
    }
}
