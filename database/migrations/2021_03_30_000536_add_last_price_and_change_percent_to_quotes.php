<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastPriceAndChangePercentToQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('last_quotes', function (Blueprint $table) {
            $table->float('previous_close', 8, 4)->nullable();
            $table->float('change', 8, 4)->nullable();
            $table->float('change_percent', 8, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
