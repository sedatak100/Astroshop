<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Model\Users\User();
        $user->user_group_id = 1;
        $user->status = 1;
        $user->firstname = 'Yasin';
        $user->lastname = 'DURAN';
        $user->email = 'contact@yassey.com';
        $user->password = Hash::make('123321');
        $user->save();
    }
}
