<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventDescriptionToEventsTable extends Migration {

    public function up() {
        Schema::table('events', function (Blueprint $table) {
            $table->string('event_description')->after('event_name')->nullable();
        });
    }

    public function down() {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('event_description');
        });
    }
}
