<?php

namespace App\Livewire;

use App\Models\CountryPhoneCode;
use App\Models\FormSubmit;
use App\Models\User;
use GeoIp2\Database\Reader;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Form extends Component
{
    public $email;
    public $phone;
    public $name;
    public $surname;
    public $phone_code;
    public bool $success = false;

    public array $submitRules = [
        'email' => ['required', 'email', 'max:255', 'string', 'regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/'],
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'phone' => 'required|string|digits_between:10,11'
    ];

    public function mount(){
        $this->phone_code = $this->getPhoneCodeByIpAddress();
    }
    public function render()
    {
        $country_phone_codes = CountryPhoneCode::orderBy('code', 'ASC')->get()->unique('code');
        return view('livewire.form', compact('country_phone_codes'));
    }

    public function getPhoneCodeByIpAddress(){
        //Local'de ip alınamadığı için uygulayamadım. Yoksa geoip ile yapılabilirdi. Şuan default TR kodu.
        return '+90';
    }

    public function submit(){
        /* Eposta ve Telefonu doğrulamak için confirmation mail yollamak isterdim fakat kurumsal bir mail adresine ve sms
        servisine kayıt olmadığım için yapamıyorum. */

        $this->validate($this->submitRules);
        return DB::transaction(function (){
            $form = new FormSubmit();
            $form->email = trim($this->email);
            $form->name = trim($this->name);
            $form->surname = trim($this->surname);
            $form->phone = $this->phone_code.trim($this->phone);
            if ($form->save()){
                $this->email = '';
                $this->name = '';
                $this->surname = '';
                $this->phone = '';
                $this->phone_code = $this->getPhoneCodeByIpAddress();
                $this->success = true;
            } else {
                $this->addError('unknownError', 'Something went wrong');
            }


        });
    }
}
