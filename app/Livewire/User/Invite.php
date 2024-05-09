<?php

namespace App\Livewire\User;
use App\Models\Customers\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Invite extends Component
{
    public $name;
    public $email;
    public $customer_id;
    public $type;
    public $invite;

    public function mount(\App\Models\Invite $record)
    {
      if ($record->id)
      {
          $this->invite = $record;
          $this->name = $record->name;
          $this->email = $record->email;
          $this->type = $record->type;
          $this->customer_id = $record->customer_id;
      }
    }

    public function render()
    {
        $customers = Customer::all();
        return view('livewire.user.invite', compact('customers'));
    }

    protected $submitRules = [
        'name' => 'required|string|max:255',
        'email' => 'min:6|required|email|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'Name & Surname field is required.',
        'name.max' => "Name & Surname field can't be longer than 255 characters.",
        'email.required' => 'E-Mail field is required.',
        'email.email' => 'Please check your e-mail address',
        'email.max' => "E-Mail field can't be longer than 255 characters.",
        'email.min' => "E-Mail field should has at least 6 characters.",
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
        } else if ((\App\Models\Invite::where('email', trim($this->email))->first()) && $this->invite?->email != trim($this->email)){
            $this->addError('submit', 'This email is already exist.');
            return;
        } else if ($this->type == 'customer' && !$this->customer_id)
        {
            $this->addError('submit', 'Please select a customer.');
            return;
        }

        DB::transaction(function(){
            if ($this->invite) {
                $invite = $this->invite;
                if (trim($this->email) != $invite->email){
                    //Email has been changed. Send Invite with same token ($invite->token)
                }
            } else {
                $invite = new \App\Models\Invite();
                $invite->token = sha1(time());
                //Send Invite Mail Here
            }

            $invite->name = $this->name;
            $invite->email = trim($this->email);
            $invite->type = $this->type;
            $invite->customer_id = $this->customer_id ?: null;
            $invite->save();
            if ($this->invite){
                return redirect()->route('users.edit-invite',['invite_id' => $this->invite->id])->with('success', 'Invite has been updated.');
            } else {
                return redirect()->route('users.create-invite')->with('success', 'Invite has sent successfully.');
            }
        });
    }
}
