<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['cat one', 'cat two', 'cat three'];
        $categories1 = ['مجموعه 1', 'مجموعه 2', 'مجموعه 3'];

        foreach ($categories as $category) {

            \App\Category::create([
                'en' => ['name' => $category],
            ]);

        }//end of foreach

        foreach ($categories1 as $category1) {

            \App\Category::create([
                'ar' => ['name' => $category1],
            ]);

        }//end of foreach

    }//end of run

}//end of seeder
