<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_role')->nullable();
            $table->unsignedSmallInteger('id_district')->nullable();
            $table->string('address')->nullable();

            $table->foreign('id_role')->references('id')->on('role');
            $table->foreign('id_district')->references('id')->on('district');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_role']);
            $table->dropForeign(['id_district']);
            $table->dropColumn(['id_role', 'id_district']);
        });
    }
}
