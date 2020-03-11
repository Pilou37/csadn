<?php

use App\Saison;
use Illuminate\Database\Seeder;

class SaisonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Saison::truncate();

        Saison::create(['nom' => '2017/2018']);
        Saison::create(['nom' => '2018/2019']);
        Saison::create(['nom' => '2020/2021']);
    }
}
