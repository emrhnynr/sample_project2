<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\FormSubmit as PageModel;

class FormList extends Component
{

    public $search = '';
    public int $perPage = 5;
    public int $page = 1;
    public int $formsCount = 0;
    public function render()
    {
        $formsBefore = PageModel::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('surname', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('phone', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'desc')->get();
        $total_pages = ceil($formsBefore->count() / $this->perPage);
        $startFrom = ($this->page * $this->perPage) - $this->perPage;
        $forms = $formsBefore->skip($startFrom)->take($this->perPage);
        $this->formsCount = $formsBefore->count();
        $formsCount = $this->formsCount;
        return view('livewire.dashboard.form-list', compact('forms', 'total_pages', 'formsCount'));
    }

    public function delete(PageModel $record)
    {
        $record->delete();
        if (($this->formsCount % $this->perPage == 1) && ($this->formsCount >= $this->perPage + 1)){
            $this->page = 1;
        }
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
