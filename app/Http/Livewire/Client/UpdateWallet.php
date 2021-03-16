<?php

namespace App\Http\Livewire\Client;

use App\Models\Stock;
use App\Models\Wallet;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class UpdateWallet extends Component
{
    public $walletID = -1;
    public $selectedStock = [];
    public $selectedGoals = [];
    public $name = '';
    public $wallet;

    public function mount(Request $request)
    {
        $this->wallet = Wallet::firstOrCreate(['id' => $this->walletID], ['name' => $this->name])->load('stocks');
    }

    public function updatedSelectedStock($value, $name)
    {
        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $name) {
                $stock->pivot->stock_symbol = $value;
                $stock->pivot->save();
                break;
            }
        }
    }

    public function updatedSelectedGoals($value, $name)
    {
        if ($value > 100 || $value < 0) {
            session()->flash('error', 'O objetivo precisa estar entre 0% e 100%.');
            return;
        }

        $pivot = null;
        $goal = 0;
        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $name) {
                $pivot = $stock->pivot;
                break;
            }
            $goal += $stock->pivot->goal;
        }

        if (($goal + $value) > 100) {
            session()->flash('error', 'O objetivo somado não pode ultrapassar 100%.');
        } else {
            $pivot->goal = $value;
            $pivot->save();
        }
    }

    public function addStock()
    {
        $stock = Stock::first();
        $goal = 100;
        foreach ($this->wallet->stocks as $stock) {
            $goal -= $stock->pivot->goal;
        }
        $this->wallet->stocks()->attach($stock, ['goal' => $goal]);
        $this->wallet->load('stocks');
    }

    public function removeStock($id)
    {
        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $id) {
                $stock->pivot->delete();
                break;
            }
        }
        $this->wallet->load('stocks');
    }

    public function render()
    {
        return view('client.livewire.update-wallet', [
            'dbStocks' => Stock::all()
        ]);
    }
}
