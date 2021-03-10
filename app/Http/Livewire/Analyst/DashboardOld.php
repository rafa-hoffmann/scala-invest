<?php

namespace App\Http\Livewire\Analyst;

use App\Models\Analyst;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardOld extends Component
{
    use WithPagination;

    public $isOpen = 0;
    private $clients;

    public function render()
    {
        $this->clients = User::where('analyst_id',Auth::id())->orderBy('id', 'desc')->paginate(10);
        return view('analyst.livewire.dashboard', [
            'clients' => $this->clients
        ]);
    }

    public function createClient(){       
    
        User::create([
            'analyst_id'=>Auth::guard('analyst')->id(),
            'email'=>'a@b.com',
            'name'=>'User',
            'password'=>Hash::make('1234'),
        ]);

        //return $this->render();
    }
}
