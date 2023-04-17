<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrganizationDescriptionOptional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Make the description field optional in the organizations table
        Schema::table('organizations', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Make the description field required in the organizations table
        Schema::table('organizations', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
        });
    }
}
