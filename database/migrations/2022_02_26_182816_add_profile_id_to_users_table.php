<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileIdToUsersTable extends Migration {

    public function up() {
        Schema::table('users', function (Blueprint $table) {
          $table->unsignedBigInteger('profile_id')->nullable()->after('password');
          $table->foreign('profile_id')->references('id')->on('user_profiles');  
        });
    }

    public function down() {

        Schema::dropForeign('profile_id');

        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('profile_id');
        });
    }
}
