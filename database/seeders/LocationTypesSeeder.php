<?php

namespace Database\Seeders;

use App\Models\LocationType;
use Illuminate\Database\Seeder;

class LocationTypesSeeder extends Seeder {

    public function run() {
        LocationType::updateOrCreate(['id' => 1], ['name' => 'Physical']);
        LocationType::updateOrCreate(['id' => 2], ['name' => 'Remote']);
    }
}
