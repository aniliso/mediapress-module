<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediapressMediaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediapress__media_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your translatable fields
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();

            $table->integer('media_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['media_id', 'locale']);
            $table->foreign('media_id')->references('id')->on('mediapress__media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mediapress__media_translations', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });
        Schema::dropIfExists('mediapress__media_translations');
    }
}
