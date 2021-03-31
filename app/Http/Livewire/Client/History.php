<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;
use Illuminate\Http\Request;

class History extends Component
{
    public $wallet;

    public function mount(Request $request)
    {
        $wallet = auth()->user()->wallets()->findOrFail($request->id)->load('histories', 'histories.stock');
        $this->wallet = $wallet;
    }

    public function render()
    {
        return view('client.livewire.history');
    }
}
