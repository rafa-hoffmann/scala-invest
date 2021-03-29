<?php

namespace App\Http\Livewire\Analyst;

use App\Mail\ClientCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

use function Ramsey\Uuid\v1;

class Dashboard extends Component
{
    use WithPagination;

    public  $name, $email, $user_id, $status, $last_name;
    public $rg;
    public $cpf;
    public $phone;
    public $street;
    public $number;
    public $complement;
    public $neighborhood;
    public $city;
    public $state;
    public $zip_code;
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
        unset($this->user_id);
        $this->last_name = '';
        $this->rg = '';
        $this->cpf = '';
        $this->phone = '';
        $this->street = '';
        $this->number = '';
        $this->complement = '';
        $this->neighborhood = '';
        $this->city = '';
        $this->state = '';
        $this->zip_code = '';
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
            'last_name' => 'required|min:2',
            'rg' => 'required|min:4',
            'cpf' => 'required|min:4',
            'phone' => 'required|min:4',
            'street' => 'required|min:4',
            'number' => 'required|min:1',
            'neighborhood' => 'required|min:1',
            'city' => 'required|min:4',
            'state' => 'required|min:2',
            'zip_code' => 'required|min:4'
        ]);
        $password = Str::random(10);
        $data = [
            'name'=>$this->name,
            'email'=>$this->email,
            'last_name' => $this->last_name,
            'rg' => $this->rg,
            'cpf' => $this->cpf,
            'phone' => $this->phone,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'analyst_id'=>Auth::guard('analyst')->id()
        ];   

        $old = User::find($this->user_id);

        if($old == null || $old['email'] != $data['email']){
            $data['password'] = Hash::make($password);
            $data['status'] = 'ENVIADO';
        }

        $user = User::updateOrCreate(['id' => $this->user_id],$data);
        $this->clients[] = $user;

        if(!empty($data['password'])){
            Mail::to($user)->send(new ClientCreated($data['name'], $password));
        }

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
        $this->last_name = $user->last_name;
        $this->rg = $user->rg;
        $this->cpf = $user->cpf;
        $this->phone = $user->phone;
        $this->street = $user->street;
        $this->number = $user->number;
        $this->complement = $user->complement;
        $this->neighborhood = $user->neighborhood;
        $this->city = $user->city;
        $this->state = $user->state;
        $this->zip_code = $user->zip_code;
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $this->user_id = $id;
        $user = User::findOrFail($id);
        if($user->status == 'ATIVO' || $user->status == 'ENVIADO'){
            $user->status = 'INATIVO';
        }
        else if($user->status == 'INATIVO'){
            $user->status = 'ENVIADO';
        }
        $user->save();
        session()->flash('message', 'Cadastro alterado.');
    }

}