<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMediaTypeColumnToMediapressMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mediapress__media', function (Blueprint $table) {
            $table->enum("media_type", ["physical", "digital"])->default("physical");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mediapress__media', function (Blueprint $table) {
            $table->dropColumn("media_type");
        });
    }
}
