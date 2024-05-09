<?php

namespace App\Livewire\Customer;

use App\Models\Customers\Customer as PageModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateCustomer extends Component
{

    public $name;
    public $collectionId;
    public $customer;


    public function mount(PageModel $record)
    {
        if ($record->id){
            $this->customer = $record;
            $this->name = $record->name;
            $this->collectionId = $record->collection_id;
        }
    }

    public function render()
    {
        return view('livewire.customer.create-customer');
    }

    protected $submitRules = [
        'name' => 'required|max:255',
        'collectionId' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Customer name field is required.',
        'name.max' => "Customer name field can't be longer than 255 characters.",
        'collectionId.required' => 'Collection ID field is required.'
    ];

    public function submit()
    {
        $this->validate($this->submitRules, $this->messages);
        if ((PageModel::where('name', $this->name)->first()) && $this->customer?->name != $this->name){
            $this->addError('submit', 'Customer name is already exist.');
            return;
        } else if ((PageModel::where('collection_id', $this->collectionId)->first()) && $this->customer?->collection_id != $this->collectionId){
            $this->addError('submit', 'Collection ID is already exist.');
            return;
        }

        DB::transaction(function(){
            if ($this->customer){
                $customer = $this->customer;
            } else {
                $customer = new PageModel();
            }
            $customer->name = $this->name;
            $customer->collection_id = $this->collectionId;
            $customer->save();
            if ($this->customer){
                return redirect()->route('customers.edit',['customer_id' => $this->customer->id])->with('success', 'Customer has been updated.');
            } else {
                return redirect()->route('customers.create')->with('success', 'Customer has been created.');
            }
        });
    }
}
