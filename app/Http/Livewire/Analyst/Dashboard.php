<?php

namespace App\Http\Livewire\Analyst;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

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
        dd('close');
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
        dd('oila');
        // $this->validate([
        //     'name' => 'required|unique:companies,name,'.$this->user_id,
        // ]);
        // $data = array(
        //     'name' => $this->name
        // );
        // $company = User::updateOrCreate(['id' => $this->user_id],$data);
        // session()->flash('message', $this->user_id ? 'Company updated successfully.' : 'Company created successfully.');
        // $this->closeModal();
        // $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $company = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $company->name;
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
        User::find($id)->delete();
        session()->flash('message', 'Company deleted successfully.');
    }

}