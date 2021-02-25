<?php

namespace App\Http\Livewire\Admin;

use App\Models\Analyst;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $isOpen = false;
    public $analyst_id = -1;
    public $name;
    public $email;
    public $password;

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->analyst_id = -1;
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function store()
    {
        $data = $this->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:analysts',
            'password' => 'required|min:4',
        ]);

        Analyst::create($data);
        session()->flash('message', 'Analista criado.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $analyst = Analyst::withTrashed()->findOrFail($id);
        $this->analyst_id = $id;
        $this->name = $analyst->name;
        $this->email = $analyst->email;
        $this->openModal();
    }

    public function update()
    {
        $data = $this->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:analysts,email,' . $this->analyst_id,
            'password' => 'sometimes|nullable|min:4',
        ]);

        $analyst = Analyst::withTrashed()->findOrFail($this->analyst_id);
        $analyst->name = $this->name;
        $analyst->email = $this->email;

        if (!empty($data['password'])) {
            $analyst->password = Hash::make($this->password);
        }

        $analyst->save();
        session()->flash('message', 'Analista atualizado.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function render()
    {
        return view('admin.livewire.dashboard', [
            'analysts' => Analyst::orderBy('id', 'desc')->withTrashed()->paginate(10)
        ]);
    }

    public function delete($id)
    {
        $analyst = Analyst::withTrashed()->findOrFail($id);

        if ($analyst->trashed()) {
            $analyst->restore();
            session()->flash('message', 'Analista restaurado.');
        } else {
            $analyst->delete();
            session()->flash('message', 'Analista excluído.');
        }
    }
}
