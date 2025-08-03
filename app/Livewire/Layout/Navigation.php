<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navigation extends Component
{
    public $searchQuery = '';
    public $sidebarOpen = false;

    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
