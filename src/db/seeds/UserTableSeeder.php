<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// Truncate the user table to clear all users and reset the ID sequence
		DB::table('users')->truncate();

		\App\User::create(array(
        	    'name'     => 'admin',
        	    'email'    => 'admin@example.com',
        	    'password' => \Hash::make('password'),
        	    'isAdmin'  => 1
        	));
        	
        	\App\User::create(array(
        	    'name'     => 'user',
        	    'email'    => 'user@example.com',
        	    'password' => \Hash::make('1234')
        	));
	}

}
