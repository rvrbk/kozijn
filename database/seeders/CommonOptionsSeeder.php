<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommonOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('common_options')->insert([
            'canvas_color' => '100 100 0 0',
            'door_color' => '69 24 0 27'
        ]);
    }
}
