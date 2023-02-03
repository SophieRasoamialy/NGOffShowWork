<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCdoIsvalieToCDOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_d_o_s', function (Blueprint $table) {
            $table->boolean('cdo_isvalide')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_d_o_s', function (Blueprint $table) {
            $table->dropColumn('cdo_isvalid');
        });
    }
}
