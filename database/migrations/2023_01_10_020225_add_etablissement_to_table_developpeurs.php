<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtablissementToTableDeveloppeurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developpeurs', function (Blueprint $table) {
            $table->string('developpeur_etablissement')->after('lastname');
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
            $table->dropColumn('developpeur_etablissement');
        });
    }
}
