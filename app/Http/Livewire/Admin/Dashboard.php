<?php

namespace App\Http\Livewire\Admin;

use App\Models\Analyst;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public function render()
    {
        return view('admin.livewire.dashboard', [
            'analysts' => Analyst::orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
