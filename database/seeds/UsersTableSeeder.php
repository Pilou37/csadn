<?php

use App\Role;
use App\User;
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
        User::truncate();

        $users = factory(User::class, 20)->create();

        foreach($users as $user) {
            $user->reglements()->createMany(factory(App\Reglement::class, 2)->make()->toArray());
        }

        //$adminRole = Role::where('nom', 'admin')->first();
        $admin = User::find(1);
        $admin->email = 'admin@admin.fr';
        $admin->addRole('admin');
        //$admin->roles()->attach($adminRole);
        $admin->save();

        $user = User::find(2);
        $user->email = 'user@user.fr';
        //$admin->addRole('admin');
        //$admin->roles()->attach($adminRole);
        $user->save();


    }
}
