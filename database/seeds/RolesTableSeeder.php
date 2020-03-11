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
        Role::truncate();

        Role::create(['nom' => 'responsable']);
        Role::create(['nom' => 'secretariat']);
        Role::create(['nom' => 'comptabilite']);
        Role::create(['nom' => 'admin']);
    }
}
