<?php
use App\User;
use App\Role;
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
        $role_admin     = Role::where('name', 'admin')->first();
        $user           = new User();
        $user->name     = 'Admin';
        $user->email    = 'admin@example.com';
        $user->provincia    = 'Asturias';
        $user->direccion    = 'Calle Eduardo Sierra 19';
        $user->cp    = '33820';
        $user->telefono    = '676543251';
        $user->role_id  = '1';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
