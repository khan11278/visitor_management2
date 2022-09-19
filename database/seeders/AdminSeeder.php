<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user= new User;
        $user->name="Ambani";
        $user->email="ambani@gmail.com";
        $user->password=Hash::make('123');
        $user->type="Admin";
        $user->user_status="Enable";
        $user->save();
    }
}
