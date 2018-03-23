<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_user = Role::where('name', 'user')->first();
      $role_admin = Role::where('name', 'admin')->first();

      $user = new User();
      $user->name = 'Laymont Arratia';
      $user->email = 'laymont@gmail.com';
      $user->password = bcrypt('12215358');
      $user->save();
      $user->roles()->attach($role_admin);

      $user = new User();
      $user->name = 'Jose M. Laya';
      $user->email = 'ventas@powerus.com.ve';
      $user->password = bcrypt('123456');
      $user->save();
      $user->roles()->attach($role_user);

    }
  }
