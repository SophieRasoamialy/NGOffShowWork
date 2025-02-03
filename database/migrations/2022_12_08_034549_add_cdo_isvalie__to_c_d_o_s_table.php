<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCdoIsvalieToCdoSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_d_o_s', function (Blueprint $table) {
            if (!Schema::hasColumn('c_d_o_s', 'cdo_isvalide')) {
                $table->boolean('cdo_isvalid')->default(false);
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
        Schema::table('c_d_o_s', function (Blueprint $table) {
            if (Schema::hasColumn('c_d_o_s', 'cdo_isvalid')) {
                $table->dropColumn('cdo_isvalid');
            }
        });
    }
}
