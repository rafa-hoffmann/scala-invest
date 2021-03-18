<?php

namespace App\Http\Livewire\Client;

use App\Models\Stock;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Livewire\Component;

class BuySellWallet extends Component
{

    public $selectedQnt = [];
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
            $this->selectedQnt[$stock->pivot->id] = 0;
        }
        $this->name = $wallet->name;
        $this->wallet = $wallet;
        $this->validateOnly('name');
    }

    public function comprarStock($id)
    {
        $this->validateOnly('name');
        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $id) {
                $stock->pivot->comprado += $this->selectedQnt[$id];
                $stock->pivot->save();
                $this->selectedQnt[$id] = 0;
                session()->flash('success', "Comprado(s) ".$this->selectedQnt[$id]." cotas de $stock->symbol");
                break;
            }
        }
        $this->wallet->load('stocks');
    }

    public function venderStock($id)
    {
        $this->validateOnly('name');
        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $id) {
                //$stock->pivot->comprado -= $this->selectedQnt[$id];
                $stock->pivot->save();
                $this->selectedQnt[$id] = 0;
                session()->flash('success', "Vendidos(s) ".$this->selectedQnt[$id]." cotas de $stock->symbol");
                break;
            }
        }
        $this->wallet->load('stocks');
    }


    public function render()
    {
        return view('client.livewire.buysell-wallet', [
            'dbStocks' => Stock::all()
        ]);
    }
}
