<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;
    public function render()
    {
        return view('livewire.login');
    }

    public function submit(){

        $this->validate(User::$loginRules);

        return DB::transaction(function(){

            if (Auth::attempt(['email' => trim($this->email), 'password' => trim($this->password)])) {
                return redirect()->route('dashboard.home');
            } else {
                $this->addError('invalidCredentials', 'Email or password is incorrect.');
            }

        });
    }
}
