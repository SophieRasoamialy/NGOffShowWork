<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjoutEtSupprimerColonne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depots', function (Blueprint $table) {
            $table->dropColumn("gagnant");
            $table->text("depot_remarque")->default("")->after("depot_lien_git");
            $table->integer("depot_note")->default(0)->after("depot_remarque");
            $table->boolean("depot_isaccepted")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depots', function (Blueprint $table) {
            $table->dropColumn("depot_remarque");
            $table->dropColumn("depot_note");
            $table->dropColumn("depot_isaccepted");
        });
    }
}
