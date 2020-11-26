<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RootUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        	'name'=>'Debbrota Roy',
        	'email'=>'roydebbrota@gmail.com',
        	'phone'=>'01914468204',
        	'name'=>'Debbrota Roy',
        	'password'=>Hash::make('12345678'),
        	'role'=>'admin'
        ]);
    }
}
