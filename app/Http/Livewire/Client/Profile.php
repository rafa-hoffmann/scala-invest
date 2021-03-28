<?php

namespace App\Http\Livewire\Client;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $userId;
    public $name;
    public $last_name;
    public $email;
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
    public $status;
    public $analystId;
    public $oldPassword;
    public $newPassword;
    public $deleteModalOpen = false;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'last_name' => 'required|min:2',
        'rg' => 'required|min:4',
        'cpf' => 'required|min:4',
        'phone' => 'required|min:4',
        'street' => 'required|min:4',
        'number' => 'required|min:1',
        'neighborhood' => 'required|min:1',
        'city' => 'required|min:4',
        'state' => 'required|min:4',
        'zip_code' => 'required|min:4',
        'newPassword' => 'password'
    ];

    public function mount()
    {
        $this->userId = auth()->user()->id;
        $model = User::find($this->userId);
        $this->name = $model->name;
        $this->email = $model->email;
        $this->last_name = $model->last_name;
        $this->rg = $model->rg;
        $this->cpf = $model->cpf;
        $this->phone = $model->phone;
        $this->street = $model->street;
        $this->number = $model->number;
        $this->complement = $model->complement;
        $this->neighborhood = $model->neighborhood;
        $this->city = $model->city;
        $this->state = $model->state;
        $this->zip_code = $model->zip_code;
        $this->status = $model->status;
        $this->analystId = $model->analyst_id;
        $this->oldPassword = $model->password;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->userId,
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
        $data = [
            'name'=>$this->name,
            'email'=>$this->email,
            'analyst_id'=>$this->analystId,
            'password'=>$this->oldPassword,
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
            'status'=>'ATIVO', //Possiveis valores: ENVIADO,ATIVO,INATIVO
        ];

        if (!empty($this->newPassword)) {
            $this->validate([
                'newPassword' => 'required|min:4'
            ]);
            $data['password'] = Hash::make($this->newPassword);
        }

        User::updateOrCreate(['id' => $this->userId],$data);

        session()->flash('message', 'Cadastro atualizado.');
        return redirect()->to('/client/profile');
    }

    public function render()
    {
        return view('client.livewire.profile');
    }

    public function showDeleteModal(){
        $this->deleteModalOpen = true;
    }

    public function closeModal()
    {
        $this->deleteModalOpen = false;
    }

    public function deactivateAccount(){
        $user = User::findOrFail($this->userId);
        $user->status = 'INATIVO';
        $user->save();
        Auth::guard('web')->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect('/');
    }
}
