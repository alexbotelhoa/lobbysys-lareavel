<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => ('admin'),
            'email' => ('admin@lobbysys.com'),
            'password' => Hash::make('12345678'),
        ]);

        factory(App\User::class, 20)->create();
    }
}
