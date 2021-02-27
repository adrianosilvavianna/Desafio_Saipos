<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('technologies')->insert([
            ['name' => 'C#'],
            ['name' => 'JavaScript'],
            ['name' => 'NodeJs'],
            ['name' => 'Angular'],
            ['name' => 'React'],
            ['name' => 'Ionic'],
            ['name' => 'Mensageria'],
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
        ]);
    }
}

