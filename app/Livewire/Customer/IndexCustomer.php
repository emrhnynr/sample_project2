<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use App\Models\Customers\Customer as PageModel;

class IndexCustomer extends Component
{
    public $search = '';
    public int $perPage = 20;
    public int $page = 1;

    public function render()
    {
        $customers = PageModel::where('name', 'like', '%'.$this->search.'%')->orWhere('collection_id', 'like', '%'.$this->search.'%')->orderBy('created_at', 'desc')->get();
        $total_pages = ceil($customers->count() / $this->perPage);
        $startFrom = ($this->page * $this->perPage) - $this->perPage;
        $customers = $customers->skip($startFrom)->take($this->perPage);
        return view('livewire.customer.index-customer', compact('customers', 'total_pages'));
    }

    public function delete(PageModel $record)
    {
        $record->delete();
    }

    public function updatedSearch()
    {
        $this->page = 1;
    }

    public function changePage(int $page)
    {
        $this->page = $page;
    }
}
