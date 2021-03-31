<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class Wallet extends Component
{
    public $wallets;
    public $stockChart = [];
    public $recommendedChart = [];
    public $sectorChart = [];
    public $totalComprado = [];
    public $totalGoal = [];

    public function mount() {
        $wallets = auth()->user()->wallets()->withCount('stocks')->with('stocks', 'stocks.last_quote')->get();
        foreach ($wallets as $wallet) {
            if ($wallet->stocks_count == 0) {
                $wallet->delete();
            }
            $this->totalComprado[$wallet->id] = 0;
            $this->totalGoal[$wallet->id] = 0;
            foreach ($wallet->stocks as $stock) {
                $this->totalComprado[$wallet->id] += $stock->pivot->comprado;
                $this->totalGoal[$wallet->id] += $stock->pivot->goal;
                $this->stockChart[$wallet->id]['data'][] = $stock->patrimonio_att;
                $this->stockChart[$wallet->id]['legends'][] = $stock->symbol;
                $this->recommendedChart[$wallet->id]['data'][] = $stock->pivot->goal*100;
                $this->recommendedChart[$wallet->id]['legends'][] = $stock->symbol;
            }
            $i = 0;
            foreach ($wallet->stocks->groupBy('sector') as $sector => $stocks) {
                $this->sectorChart[$wallet->id]['legends'][] = $sector;
                $this->sectorChart[$wallet->id]['data'][$i] = 0;
                foreach ($stocks as $stock) {
                    $this->sectorChart[$wallet->id]['data'][$i] += $stock->patrimonio_att;
                }
                $i++;
            }
        }
        $this->wallets = auth()->user()->wallets()->get();
    }

    public function render()
    {
        return view('client.livewire.wallet');
    }
}
