<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activites')->insert([
            'nom' => 'Judo',
            'tarif' => 120
        ]);
        DB::table('activites')->insert([
            'nom' => 'Futsal',
            'tarif' => 40
        ]);
        DB::table('activites')->insert([
            'nom' => 'Musculation / Remise en forme',
            'tarif' => 80
        ]);
    }
}
