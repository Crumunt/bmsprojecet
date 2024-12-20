<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS-DEC</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="{{ asset('assets/images/logo/clsu_logo.png') }}" alt="CLSU Logo">
            <h1>Central Luzon State University</h1>
            <p class="sub-text">Nueva Ecija, Philippines</p>
        </div>
        <div class="form-section">
            <livewire:login.login-form />
        </div>
    </div>
</body>

</html>
