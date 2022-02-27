<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesToEventsTable extends Migration {

    public function up() {
        Schema::table('events', function (Blueprint $table) {
          $table->string('notes')->after('zipcode')->nullable();
        });
    }

    public function down() {
        Schema::table('events', function (Blueprint $table) {
          $table->dropColumn('notes');  
        });
    }
}
