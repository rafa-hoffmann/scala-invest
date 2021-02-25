<?php

namespace App\Http\Livewire\Analyst;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Ramsey\Uuid\Generator\PeclUuidRandomGenerator;
use Ramsey\Uuid\Generator\RandomGeneratorFactory;

class Dashboard extends Component
{
    use WithPagination;

    public  $name, $email, $user_id;
    public $isOpen = 0;
    private $clients;

    public function render()
    {
        $this->clients = User::where('analyst_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        return view('analyst.livewire.dashboard',[
            'clients' => $this->clients
        ]);
    }

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function create()
    {
        //$this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
        // Clean errors if were visible before
        $this->resetErrorBag();
        $this->resetValidation();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->user_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
        ]);
        $password = 1234;
        $this->clients[] = User::updateOrCreate(['id' => $this->user_id],[
            'name'=>$this->name,
            'email'=>$this->email,
            'analyst_id'=>Auth::guard('analyst')->id(),
            'password'=>$password,
            'status'=>'ENVIADO', //Possiveis valores: ENVIADO,ATIVO,INATIVO
        ]);
        session()->flash('message', $this->user_id ? 'Cliente atualizado.' : 'Cliente criado.');
        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public function delete($id)
    // {
    //     $this->user_id = $id;
    //     User::find($id)->delete();
    //     session()->flash('message', 'Company deleted successfully.');
    // }

}