<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $saleRole = Role::where('name', 'sale')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('asd123!@#'),
        ]);

        $sale = User::create([
            'name' => 'Sale',
            'email' => 'sale@gmail.com',
            'password' => bcrypt('asd123!@#'),
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('asd123!@#'),
        ]);

        $admin->roles()->attach($adminRole);
        $sale->roles()->attach($saleRole);
        $user->roles()->attach($userRole);

 
    }
}
