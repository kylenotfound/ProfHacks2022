<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypesSeeder extends Seeder {

    public function run() {
      EventType::updateOrCreate(['id' => 1], ['name' => 'Volunteering']);
      EventType::updateOrCreate(['id' => 2], ['name' => 'Fundraiser']);
      EventType::updateOrCreate(['id' => 3], ['name' => 'Protest']);
    }
}
