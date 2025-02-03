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
            if (!Schema::hasColumn('developpeurs', 'developpeurs_isvalid')) {
                $table->boolean('developpeurs_isvalid')->default(false);
            }
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
            if (Schema::hasColumn('developpeurs', 'developpeurs_isvalide')) {
                $table->dropColumn('developpeurs_isvalid');
            }
        });
    }
}
