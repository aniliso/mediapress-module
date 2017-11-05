<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediapressMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediapress__media', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->enum('media_type', ['web', 'tv', 'news']);
            $table->string('media_desc')->nullable();
            $table->string('brand')->nullable();
            $table->text('settings')->nullable();

            $table->date('release_at')->nullable();
            $table->mediumInteger('sorting')->nullable();
            $table->smallInteger('status')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mediapress__media');
    }
}
