<?php

namespace App\Http\Livewire\Client;

use App\Models\Wallet as ModelsWallet;
use Livewire\Component;

class Wallet extends Component
{
    public $wallets;

    public function mount() {
        $wallets = ModelsWallet::withCount('stocks')->get();
        foreach ($wallets as $wallet) {
            if ($wallet->stocks_count == 0) {
                $wallet->delete();
            }
        }
        $this->wallets = ModelsWallet::get();
    }

    public function render()
    {
        return view('client.livewire.wallet');
    }
}
