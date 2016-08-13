<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	['name' => '系統開發人員', 'username' => 'admin', 'email' => 'admin@admin.com', 'password' => 'admin'],
        ];

        foreach ($users as $key => $value) {
        	$user = new User();
        	$user->name = $value['name'];
        	$user->username = $value['username'];
        	$user->email = $value['email'];
        	$user->password = bcrypt($value['password']);
        	$user->save();
        }
    }
}
