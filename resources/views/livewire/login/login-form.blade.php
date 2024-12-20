<div>
    {{-- In work, do what you enjoy. --}}
    <h2>Admin Portal</h2>
    <x-forms.form id="loginForm">
        <x-forms.input wire:model="user_email" class="form-floating {{ $is_invalid ? 'is-invalid' : '' }}" id="user_email"
            label="Username or Email" required />
        <x-forms.input wire:model="password" type="password" class="form-floating {{ $is_invalid ? 'is-invalid' : '' }}"
            id="password" label="Password" required />
            <div class="alert alert-danger alert-dismissible invalid-feedback">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                Invalid Username or Password
            </div>
        {{-- <a href="#" class="forgot-password">Forgot Password?</a> --}}
    </x-forms.form>
    <button class="login-btn" wire:click="validateLogin">Login</button>
</div>
