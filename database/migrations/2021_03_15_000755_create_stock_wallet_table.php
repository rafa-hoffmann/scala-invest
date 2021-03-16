<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_wallet', function (Blueprint $table) {
            $table->id();
            $table->string('stock_symbol');
            $table->unsignedBigInteger('wallet_id');
            $table->foreign('stock_symbol')->references('symbol')->on('stocks');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->unsignedDecimal('goal')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_wallet');
    }
}
