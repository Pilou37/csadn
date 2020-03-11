<?php

use App\Activite;
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
        Activite::truncate();

        DB::table('activites')->insert([
            'nom' => 'Sans activité',
            'tarif' => 28
        ]);
        DB::table('activites')->insert([
            'nom' => 'Licence temporaire',
            'tarif' => 5
        ]);
        DB::table('activites')->insert([
            'nom' => 'Badminton',
            'tarif' => 40
        ]);
        DB::table('activites')->insert([
            'nom' => 'Futsal',
            'tarif' => 40
        ]);
        DB::table('activites')->insert([
            'nom' => 'Golf',
            'tarif' => 40
        ]);
        DB::table('activites')->insert([
            'nom' => 'Cross Training',
            'tarif' => 40
        ]);
        DB::table('activites')->insert([
            'nom' => 'Art Plastique',
            'tarif' => 40
        ]);
        DB::table('activites')->insert([
            'nom' => 'Judo - Essai 1 mois',
            'tarif' => 40
        ]);
        DB::table('activites')->insert([
            'nom' => 'Musculation / Remise en forme',
            'tarif' => 80
        ]);
        DB::table('activites')->insert([
            'nom' => 'Judo - Débutant / Ceinture noire',
            'tarif' => 80
        ]);
        DB::table('activites')->insert([
            'nom' => 'Judo',
            'tarif' => 120
        ]);
        DB::table('activites')->insert([
            'nom' => 'Aïki Jujutsu',
            'tarif' => 40
        ]);
    }
}
