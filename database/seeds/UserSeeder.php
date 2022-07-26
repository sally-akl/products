<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name' => "admin",
          'email' => "admin@admin.com",
          'email_verified_at' => now(),
          'remember_token' => Str::random(10),
          'created_at' =>  Carbon::now(),
          'updated_at' => Carbon::now(),
          'password' => Hash::make('123456')
        ]);
    }

}
