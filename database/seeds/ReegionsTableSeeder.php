<?php

use Illuminate\Database\Seeder;

class ReegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['1', '2'];

        foreach ($products as $product) {

            \App\Region::create([
                'ar' => ['name' => 'مكتب'.$product],
                'en' => ['name' => 'Region'.$product],
                ]);

        }//end of foreach

    }
}
