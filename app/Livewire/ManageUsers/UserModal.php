<?php

namespace App\Livewire\ManageUsers;

use App\Models\Contractor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class UserModal extends Component
{

    public $user_id;
    public $username;
    public $email;
    public $user_type;
    public $password;
    public $confirm_password;
    public $modalStatus = '';

    public function addUser()
    {
        $user = User::create([
            'name' => $this->username,
            'email' => $this->email,
        ]);

        $user->login()->create([
            'password' => Hash::make($this->password),
            'user_type' => $this->user_type,
            'last_login_attempt' => now(),
        ]);

        $this->dispatch('refreshUserList');
    }

    public function updateUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update([
                'name' => $this->username,
                'email' => $this->email,
            ]);

            $user->login()->update([
                'user_type' => $this->user_type
            ]);

            if ($this->user_type == 'contractor') {
                $user->contractor()->create();
            }
        }

        $this->clearFields();
        $this->dispatch('refreshUserList');
    }

    #[On('loadUserModal')]
    public function loadEditModal($user, $modalStatus)
    {
        $this->user_id = $user['id'];
        $this->username = $user['name'];
        $this->email = $user['email'];
        $this->user_type = $user['login']['user_type'];
        $this->modalStatus = $modalStatus;
        // dd($this->modalStatus);
    }

    #[On('loadConfirmModal')]
    public function loadConfirmDeleteModal($user, $modalStatus)
    {
        // dd($user, $modalStatus);
        $this->user_id = $user['id'];
        $this->username = $user['name'];
        $this->modalStatus = $modalStatus;
    }

    public function confirmDeleteUser($id)
    {
        $user = User::with('login')->find($id);
        if ($user) {
            $user->delete();
        }

        $this->clearFields();
        $this->dispatch('refreshUserList');
    }

    public function clearModal()
    {
        $this->clearFields();
    }

    private function clearFields()
    {
        $this->user_id = '';
        $this->username = '';
        $this->email = '';
        $this->user_type = '';
        $this->password = '';
        $this->confirm_password = '';
        $this->modalStatus = '';
    }

    public function render()
    {
        return view('livewire.manage-users.user-modal');
    }
}
