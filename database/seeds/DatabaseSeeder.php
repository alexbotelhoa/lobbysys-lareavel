<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => ('admin'),
            'email' => ('admin@visitor.com'),
            'password' => Hash::make('12345678'),
        ]);

        $this->call([
            VisitorSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
