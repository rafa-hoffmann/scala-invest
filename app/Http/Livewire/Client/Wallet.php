<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class Wallet extends Component
{
    public $wallets;

    public function mount() {
        $wallets = auth()->user()->wallets()->withCount('stocks')->with('stocks', 'stocks.last_quote')->get();
        foreach ($wallets as $wallet) {
            if ($wallet->stocks_count == 0) {
                $wallet->delete();
            }
        }
        $this->wallets = auth()->user()->wallets()->get();
    }

    public function render()
    {
        return view('client.livewire.wallet');
    }
}
