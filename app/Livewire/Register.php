<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Register extends Component
{
    public $email;
    public $name;
    public $surname;
    public $password;
    public $repeatPassword;

    public function render()
    {
        return view('livewire.register');
    }

    public function submit(){

        $this->validate(User::$registerRules);
        if (trim($this->password) != trim($this->repeatPassword)){
            $this->addError('notSamePasswords', "Passwords are not matching.");
            return;
        }

        return DB::transaction(function(){
            $user = User::create([
                'email' => trim($this->email),
                'name' => trim($this->name),
                'surname' => trim($this->surname),
                'password' => Hash::make(trim($this->password)),
                'type' => 'admin'
            ]);

            Auth::login($user);

            return redirect()->route('dashboard.home');


        });

    }
}
