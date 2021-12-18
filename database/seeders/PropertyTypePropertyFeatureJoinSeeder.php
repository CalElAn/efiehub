<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use app\Http\Helpers\PropertyTypeToFeatureMap;

class PropertyTypePropertyFeatureJoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('PropertyType_PropertyFeature_join')->insert((new PropertyTypeToFeatureMap)->mapPropertyTypeToFeature());
    }
}
