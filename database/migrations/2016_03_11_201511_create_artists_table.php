<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('prefix', 32)
                  ->nullable();
            $table->string('mbid', 1369)
                  ->nullable();
            $table->text('summary')
                  ->nullable();
            $table->string('placeformed')
                  ->nullable();
            $table->integer('yearformed');
            $table->boolean('manual_update');
            $table->timestamps();
            $table->unsignedInteger('user_id')
                    ->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropForeign('artists_user_id_foreign');
        });
        Schema::drop('artists');
    }
}