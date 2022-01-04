<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('region')->insert([
            ['name' => 'Ashanti'],
            ['name' => 'Bono Region'],
            ['name' => 'Bono East Region'],
            ['name' => 'Ahafo Region'],
            ['name' => 'Central'],
            ['name' => 'Eastern'],
            ['name' => 'Greater Accra'],
            ['name' => 'Northern'],
            ['name' => 'Savannah'],
            ['name' => 'North East'],
            ['name' => 'Upper East'],
            ['name' => 'Upper West'],
            ['name' => 'Volta Region'],
            ['name' => 'Oti'],
            ['name' => 'Western Region'],
            ['name' => 'Western North'],
        ]);
    }
}
