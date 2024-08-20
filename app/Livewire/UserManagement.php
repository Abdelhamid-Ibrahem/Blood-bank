<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class UserManagement extends Component
{
    public function index( ): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('livewire.user-management');
    }
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.user-management');
    }
}
