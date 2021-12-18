<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Http\Helpers\PropertyTypeToFeatureMap;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_type')->insert(PropertyTypeToFeatureMap::$propertyTypeArray);
    }
}
