<?php

namespace App\Http\Livewire\Client;

use App\Models\History;
use App\Models\LastQuote;
use App\Models\Stock;
use Illuminate\Http\Request;
use Livewire\Component;

class BuySellWallet extends Component
{

    public $selectedQnt = [];
    public $sugestions = [];
    public $name = '';
    public $wallet;
    public $valor;

    public function mount(Request $request)
    {
        $this->walletID = $request->id;
        $wallet = auth()->user()->wallets()->firstOrCreate(['id' => $this->walletID], ['name' => $this->name])->load('stocks');
        foreach ($wallet->stocks as $stock) {
            $this->selectedQnt[$stock->pivot->id] = 0;
            $this->sugestions[$stock->pivot->id] = 0;
        }
        $this->name = $wallet->name;
        $this->wallet = $wallet;
        $this->valor = 0;
    }

    public function comprarStock($id)
    {
        if (!is_numeric($this->selectedQnt[$id])) {
            session()->flash('error', 'A quantidade de ações precisa ser um número.');
            return;
        }

        if ($this->selectedQnt[$id] <= 0) {
            session()->flash('error', 'Quantidade inválida');
            return;
        }

        $this->selectedQnt[$id] = round($this->selectedQnt[$id]);
        $this->sugestions[$id] = 0;
        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $id) {
                History::create([
                    'wallet_id' => $this->wallet->id,
                    'stock_symbol' => $stock->symbol,
                    'acao' => 'COMPRADO',
                    'quantidade' => $this->selectedQnt[$id]
                ]);
                $stock->pivot->comprado += $this->selectedQnt[$id];
                $stock->pivot->goal_distance =  ((($this->wallet->soma_patrimonio == 0) ? 0 : $stock->patrimonio_att / $this->wallet->soma_patrimonio * 100) - $stock->pivot->goal);
                $stock->pivot->save();
                session()->flash('success', "Comprado(s) " . $this->selectedQnt[$id] . " cotas de $stock->symbol");
                $this->selectedQnt[$id] = 0;
            }
        }
        $this->recaulate();
        $this->wallet->load('stocks');
    }

    public function venderStock($id)
    {
        if (!is_numeric($this->selectedQnt[$id])) {
            session()->flash('error', 'A quantidade de ações precisa ser um número.');
            return;
        }

        if ($this->selectedQnt[$id] <= 0) {
            session()->flash('error', 'Quantidade inválida');
            return;
        }

        $this->selectedQnt[$id] = round($this->selectedQnt[$id]);

        foreach ($this->wallet->stocks as $stock) {
            if ($stock->pivot->id == $id) {
                if ($this->selectedQnt[$id] > $stock->pivot->comprado) {
                    session()->flash('error', 'Quantidade menor que o número de ações adquiridas');
                    return;
                }
                History::create([
                    'wallet_id' => $this->wallet->id,
                    'stock_symbol' => $stock->symbol,
                    'acao' => 'VENDIDO',
                    'quantidade' => $this->selectedQnt[$id]
                ]);
                $stock->pivot->comprado -= $this->selectedQnt[$id];
                $stock->pivot->goal_distance =  ((($this->wallet->soma_patrimonio == 0) ? 0 : $stock->patrimonio_att / $this->wallet->soma_patrimonio * 100) - $stock->pivot->goal);
                $stock->pivot->save();
                session()->flash('success', "Vendidos(s) " . $this->selectedQnt[$id] . " cotas de $stock->symbol");
                $this->selectedQnt[$id] = 0;
            }
        }
        $this->recaulate();
        $this->wallet->load('stocks');
    }

    public function recaulate()
    {
        foreach ($this->wallet->stocks as $stock) {
            $stock->pivot->goal_distance = ((($this->wallet->soma_patrimonio == 0) ? 0 : $stock->patrimonio_att / $this->wallet->soma_patrimonio * 100) - $stock->pivot->goal);
            $stock->pivot->save();
        }
    }

    public function updatedValor($value)
    {
        $this->valor = $value;
    }


    public function sugerirCompra()
    {
        $goals_distances = $this->wallet->stocks->pluck('pivot')->toArray();
        //dd($goals_distances);
        $negatives = array_filter($goals_distances, function ($value) {
            return $value['goal_distance'] < 0;
        });

        $c = 0;
        foreach ($negatives as $negative) {
            $c += $negative['goal_distance'];
        }
        $percents = [];
        foreach ($negatives as $pivot) {
            $price = LastQuote::find($pivot['stock_symbol'])->price;
            $percents[$pivot['id']] = floor((abs($pivot['goal_distance'] / $c) * $this->valor) / $price);
        }
        $this->sugestions = $percents;
    }


    public function render()
    {
        $this->sugerirCompra();
        return view('client.livewire.buysell-wallet', [
            'dbStocks' => Stock::all()
        ]);
    }
}
