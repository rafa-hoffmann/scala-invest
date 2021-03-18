<?php

namespace App\Http\Livewire\Client;

use App\Models\Stock;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Livewire\Component;

class UpdateWallet extends Component
{
    public $selectedStock = [];
    public $selectedGoals = [];
    public $name = '';
    public $wallet;

    protected $rules = [
        'name' => 'required|min:3|max:255'
    ];

    public function mount(Request $request)
    {
        $this->walletID = $request->id;
        $wallet = auth()->user()->wallets()->firstOrCreate(['id' => $this->walletID], ['name' => $this->name])->load('stocks');
        foreach($wallet->stocks as $stock) {
            $this->selectedStock[$stock->pivot->id] = $stock->symbol;
            $this->selectedGoals[$stock->pivot->id] = $stock->pivot->goal;
        }
        $this->name = $wallet->name;
        $this->wallet = $wallet;
        $this->validateOnly('name');
    }

    public function updatedSelectedStock($value, $name)
    {
        $this->validateOnly('name');
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
        $this->validateOnly('name');
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

    public function updatedName($value)
    {
        $this->validateOnly('name');
        $this->wallet->name = $value;
        $this->wallet->save();
    }

    public function addStock()
    {
        $this->validateOnly('name');
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
        $this->validateOnly('name');
        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $id) {
                $stock->pivot->delete();
                break;
            }
        }
        $this->wallet->load('stocks');
    }

    public function removeWallet() {
        $this->wallet->delete();
        return redirect('dashboard');
    }

    public function render()
    {
        return view('client.livewire.update-wallet', [
            'dbStocks' => Stock::all()
        ]);
    }
}
