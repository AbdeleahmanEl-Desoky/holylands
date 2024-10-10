<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;



class UsersAdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        if(!User::where('email','admin@email.test')->first()) {
            $user = User::create([
                'name' => 'Ahmed Admin',
                'email' => 'admin@email.test',
                'mobile' => '99999999999',
                'image' => '../dashboard/images/loge2.png',
                'password' => Hash::make("102030###"),
                'status' => 1,
            ]);

            $user->assignRole('Admin');

        }


    }
}
