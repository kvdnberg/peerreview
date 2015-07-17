<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $existingUser = User::where('email', '=', env('USER_EMAIL'))->first();

        if(!$existingUser) {
            DB::table('users')->delete();

            User::create([
                'name' => env('USER_NAME'),
                'email' => env('USER_EMAIL'),
                'password' => Hash::make(env('USER_PASSWORD'))
            ]);
        }
    }

}


