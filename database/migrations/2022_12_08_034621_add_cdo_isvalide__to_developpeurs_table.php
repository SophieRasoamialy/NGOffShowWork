<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCdoIsvalideToDeveloppeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developpeurs', function (Blueprint $table) {
            $table->boolean('developpeurs_isvalide')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developpeurs', function (Blueprint $table) {
            $table->dropColumn('developpeurs_isvalid');
        });
    }
}
