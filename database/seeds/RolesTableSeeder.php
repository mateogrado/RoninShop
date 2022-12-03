<?php
use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin                   = new Role;
        $admin->name             = 'admin';
        $admin->display_name     = 'administrador';
        $admin->description      = 'Administra los contenidos de la web';
        $admin->save();
    }
}
