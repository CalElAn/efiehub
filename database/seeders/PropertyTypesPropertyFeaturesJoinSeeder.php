<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use app\Http\Helpers\PropertyTypesToFeaturesMap;

class PropertyTypesPropertyFeaturesJoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('PropertyTypes_PropertyFeatures_join')->insert((new PropertyTypesToFeaturesMap)->mapPropertyTypesToFeatures());
    }
}
