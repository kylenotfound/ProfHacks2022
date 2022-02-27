<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRemoteToEventsTable extends Migration {

    public function up() {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('is_remote')->nullable()->after('notes');
            $table->foreign('is_remote')->references('id')->on('location_types');
        });
    }

    public function down() {

        Schema::dropForeign('is_remote');
        Schema::table('events', function (Blueprint $table) {
          $table->dropColumn('is_remote');
        });
    }
}
