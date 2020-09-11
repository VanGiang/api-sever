<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        // $this->call(UserSeeder::class);
        User::create([
            'name' => 'User 001',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'User 002',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
