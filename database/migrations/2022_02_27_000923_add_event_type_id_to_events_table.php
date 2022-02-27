<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventTypeIdToEventsTable extends Migration {

    public function up() {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_type_id')->after('is_remote');
            $table->foreign('event_type_id')->references('id')->on('event_types');
        });
    }

    public function down() {
        Schema::dropForeign('event_type_id');
        Schema::table('events', function (Blueprint $table) {
          $table->dropColumn('event_type_id');  
        });
    }
}
