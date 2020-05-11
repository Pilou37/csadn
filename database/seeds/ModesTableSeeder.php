<?php

use App\Mode;
use Illuminate\Database\Seeder;

class ModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mode::truncate();

        Mode::create(['nom' => 'Chèque']);
        Mode::create(['nom' => 'Espèce']);
        Mode::create(['nom' => 'Bon CAF']);
        Mode::create(['nom' => 'Coupon Sport']);
        Mode::create(['nom' => 'Autre']);
    }
}
