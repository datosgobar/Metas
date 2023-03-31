<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOidcUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add the following columns to the users table after the id column
        Schema::table('users', function (Blueprint $table) {
            $table->string('oidc_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the following columns from the users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('oidc_id');
        });
    }
}
