<?php

namespace App\Livewire\Login;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginForm extends Component
{
    public $user_email;
    public $password;
    public $is_invalid;

    public function validateLogin()
    {
        $user = User::where('name', $this->user_email)
            ->orWhere('email', $this->user_email)
            ->first();
        if (!$user) {
            $this->is_invalid = 1;
            return;
        }

        if (!Hash::check($this->password, $user['login']['password'])) {
            $this->is_invalid = 1;
            return;
        }

        session([
            'user_id' => $user['id'],
            'user_role' => $user['login']['user_type']
        ]);

        $this->redirect('dashboard');
    }
    public function render()
    {
        return view('livewire.login.login-form');
    }
}
