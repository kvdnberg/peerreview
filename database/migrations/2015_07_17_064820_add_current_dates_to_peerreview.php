<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrentDatesToPeerreview extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::table('peer_reviews', function (Blueprint $table) {
            $table->dateTime('current_from');
            $table->dateTime('current_to');
        });

        DB::Statement('UPDATE peer_reviews set current_from = created_at');
    }
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('peer_reviews', function (Blueprint $table) {
        $table->dropColumn('current_from');
        $table->dropColumn('current_to');
    });

    }

}
