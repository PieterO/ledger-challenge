<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User();
        $user->name = 'bob-k';
        $user->password = Hash::make('12345678');
        $user->email = 'a@test.com';
        $user->save();

        $user = new App\User();
        $user->name = 'James Shore';
        $user->password = Hash::make('abc12345678');
        $user->email = 'a@a.com';
        $user->save();

        $user = new App\User();
        $user->name = 'Money Bags';
        $user->password = Hash::make('12345678');
        $user->email = 'm.b@spyro.com';
        $user->save();
    }
}
