<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('photos', function(Blueprint $table) {
			$table->foreign('album_id')->references('id')->on('albums')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('albums', function(Blueprint $table) {
			$table->dropForeign('albums_photo_id_foreign');
		});
	}
}