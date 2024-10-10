<?php

namespace Database\Seeders;


use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $factory = Factory::create();
        $students = [1, 2, 3, 4, 5, 6, 7];
        $coaches = [1, 2, 3];
        foreach ($students as $student) {
            if (!User::where('email', 'student'.$student.'@gmail.com')->first()) {
                $user = User::create([
                    'name' => 'student '. $student,
                    'email' => 'student'.$student.'@gmail.com',
                    'mobile' => $factory->numberBetween('1','9999999999'),
                    'password' => Hash::make("123456789"),
                    'birth_date' => $factory->date,
                    'place_of_birth' => 'القدس',
                    'nationality' => 'فلسطيني',
                    'job' => 'مهندس',
                    'affiliation_date' => $factory->date,
                    'address' => 'القدس - شارع يافا',
                    'blood_type' => 'A موجب',
                    'url_facebook' => '#',
                    'lesson_count' => rand(1, 99),
                    'level_id' => rand(1, 4),
                    'status' => 1,
                ]);

                $user->assignRole('Student');

            }

        }

        foreach ($coaches as $coach) {
            if (!User::where('email', 'coach'.$coach.'@gmail.com')->first()) {
                $user = User::create([
                    'name' => 'coach '. $coach,
                    'email' => 'coach'.$coach.'@gmail.com',
                    'mobile' => $factory->numberBetween('1','9999999999'),
                    'password' => Hash::make("123456789"),
                    'birth_date' => $factory->date,
                    'place_of_birth' => 'عكا',
                    'nationality' => 'فلسطيني',
                    'job' => 'مدرب خيل',
                    'affiliation_date' => $factory->date,
                    'address' => 'القدس - شارع يافا',
                    'blood_type' => 'A موجب',
                    'url_facebook' => '#',
                    'status' => 1,
                ]);

                $user->assignRole('Coach');

            }

        }


    }
}
