<?php

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
        $users = factory(User::class, 20)->create();
        foreach($users as $user) {
            $user->reglements()->createMany(factory(App\Reglement::class, 2)->make()->toArray());
        }

        $admin = User::find(1);
        $admin->email = 'admin@admin.fr';
        $admin->save();


    }
}
