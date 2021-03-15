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
            $table->string('symbol_id');
            $table->unsignedBigInteger('wallet_id');
            $table->foreign('symbol_id')->references('symbol')->on('stocks');
            $table->foreign('wallet_id')->references('id')->on('wallets');
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
