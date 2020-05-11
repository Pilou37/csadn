<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('saison_user')->truncate();
        DB::table('role_user')->truncate();

        $users = factory(User::class, 4)->create();

        foreach($users as $user) {
            $user->reglements()->createMany(factory(App\Reglement::class, 2)->make()->toArray());
            $user->saisons()->attach(rand(1,4));
        }

        //$adminRole = Role::where('nom', 'admin')->first();
        $admin = User::find(1);
        $admin->email = 'admin@csadn.fr';
        $admin->addRole('admin');
        //$admin->roles()->attach($adminRole);
        $admin->save();

        $admin = User::find(2);
        $admin->email = 'secretaire@csadn.fr';
        $admin->addRole('secretariat');
        $admin->save();

        $admin = User::find(3);
        $admin->email = 'comptable@csadn.fr';
        $admin->addRole('comptabilite');
        $admin->save();

        $user = User::find(4);
        $user->email = 'user@user.fr';
        //$admin->addRole('admin');
        //$admin->roles()->attach($adminRole);
        $user->save();


    }
}
