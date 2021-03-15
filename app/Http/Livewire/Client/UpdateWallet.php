<?php

namespace App\Http\Livewire\Client;

use App\Models\Stock;
use Livewire\Component;

class UpdateWallet extends Component
{
    public $walletID = -1;
    public $selectedStocks = [];
    public $name;
    public $stocksCount = 0;

    public function addStock() {
        $this->stocksCount++;
    }

    public function removeStock() {
        $this->stocksCount--;
    }

    public function render()
    {
        return view('client.livewire.update-wallet', [
            'stocks' => Stock::all()
        ]);
    }
}
