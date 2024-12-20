<?php

namespace App\Livewire\ManageUsers;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserList extends Component
{

    public $users;

    public function mount()
    {
        $this->users = $this->getUsers();
    }

    #[On('refreshUserList')]
    public function refreshUserList()
    {
        $this->users = $this->getUsers();
    }

    public function loadUserData($id)
    {
        $user = $this->getUser($id);
        $this->dispatch('loadUserModal', $user, 'update');
    }

    public function confirmDelete($id) {
        $user = $this->getUser($id);
        $this->dispatch('loadConfirmModal', $user, 'delete');
    }

    private function getUsers()
    {
        return User::with('login')->get();
    }

    private function getUser($id)
    {
        return User::with('login')->find($id);
    }

    public function render()
    {
        return view('livewire.manage-users.user-list');
    }
}
