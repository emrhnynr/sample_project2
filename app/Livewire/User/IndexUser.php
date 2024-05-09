<?php

namespace App\Livewire\User;

use App\Models\Invite;
use App\Models\Invite as PageModel;
use App\Models\User;
use Livewire\Component;

class IndexUser extends Component
{
    public $search = '';
    public int $perPage = 20;
    public int $page = 1;

    public function render()
    {
        $invitees = PageModel::where('name', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%')->orWhereHas('customer', function($customer){
            return $customer->where('name', 'like', '%'.$this->search.'%');
        })->orWhereHas('user', function ($user){
            return $user->where('name', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%')->orWhereHas('customer', function($customer){
                return $customer->where('name', 'like', '%'.$this->search.'%');
            });
        })->orderBy('created_at', 'desc')->get();
        $total_pages = ceil($invitees->count() / $this->perPage);
        $startFrom = ($this->page * $this->perPage) - $this->perPage;
        $invitees = $invitees->skip($startFrom)->take($this->perPage);
        return view('livewire.user.index-user', compact('invitees', 'total_pages'));
    }

    public function deleteInvite(Invite $record)
    {
        $record->delete();
    }

    public function deleteUser(User $record)
    {
        $record->delete();
        $record->invite->delete();
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
