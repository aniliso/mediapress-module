<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBrandColumnToMediapressMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mediapress__media', function (Blueprint $table) {
            $table->integer('brand_id')->index()->nullable();
            $table->dropColumn('brand');
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
            $table->string('brand')->nullable();
            $table->dropColumn('brand_id');
        });
    }
}
