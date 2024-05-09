<?php

namespace App\Livewire\User;

use App\Models\Customers\Customer;
use App\Models\User as PageModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditUser extends Component
{

    public $name;
    public $email;
    public $customer_id;
    public $type;
    public $user;


    public function mount(PageModel $record)
    {
        if ($record->id){
            $this->user = $record;
            $this->name = $record->name;
            $this->email = $record->email;
            $this->type = $record->type;
            $this->customer_id = $record->customer_id;
        }
    }

    public function render()
    {
        $customers = Customer::all();
        return view('livewire.user.edit-user', compact('customers'));
    }

    protected $submitRules = [
        'name' => 'required|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'Name & Surname field is required.',
        'name.max' => "Name & Surname field can't be longer than 255 characters.",
    ];

    public function updatedType()
    {
        $this->customer_id = null;
    }

    public function submit()
    {
        $this->validate($this->submitRules, $this->messages);
        if ($this->type != 'admin' && $this->type != 'customer'){
            $this->addError('submit', 'Please select a user type.');
            return;
        } else if ($this->type == 'customer' && !$this->customer_id)
        {
            $this->addError('submit', 'Please select a customer.');
            return;
        }

        DB::transaction(function(){
            $user = $this->user;
            $user->name = $this->name;
            $user->type = $this->type;
            $user->customer_id = $this->customer_id ?: null;
            $user->save();
            return redirect()->route('users.edit',['user_id' => $this->user->id])->with('success', 'User has been updated.');
        });
    }
}
