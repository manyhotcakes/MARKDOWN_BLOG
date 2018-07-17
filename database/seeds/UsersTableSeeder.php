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
      DB::table('users')->insert([
          'name' => 'user',
          'email' => 'first_user@example.com',
          'password' => bcrypt('secret'),
      ]);
    }
}
