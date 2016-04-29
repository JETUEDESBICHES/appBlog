<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
        'title' => 'conférence'

    ]);

        \App\Category::create([
            'title' => 'nouveauté'

        ]);
    }
}
