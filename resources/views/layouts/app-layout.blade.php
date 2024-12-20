@props(['extraClasses' => '', 'sectionClass' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    @livewireStyles

    {{-- conditional imports --}}
    @stack('styles')

    {{-- conditional imports (js) --}}
    @stack('scripts')

    {{-- bootstrap import --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="{{ asset('assets/js/jquery.js') }}" type="text/javascript"></script>

    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    {{-- @if (session('user_role') !== 'contractor') --}}
    <x-nav />
    {{-- @endif --}}

    <section class="dashboard mt-5 {{ merge_classes('', $sectionClass) }}">
        <x-top-nav />
        <x-manage-projects.modal modalID="logoutModal" modalSize="sm">
            <x-slot:pageTitle>Logout</x-slot:pageTitle>
            Are you sure you want to log out?
            <x-slot:modalControls>
                {{-- <button class="btn btn-warning" data-bs-dimiss="modal" aria-label="Close">Cancel</button> --}}
                <div class="btn-group">
                    <a href="{{route('logout')}}" class="btn btn-success">Confirm</a>
                </div>
            </x-slot:modalControls>
        </x-manage-projects.modal>

        <div class="dashboard-title">
            @yield('page_header')
        </div>

        <div class="content-wrapper">
            <div class="main-content {{ merge_classes('', $extraClasses) }}">
                @yield('main-content')

            </div>
            @yield('sub-content')
        </div>
    </section>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @livewireScripts
</body>

</html>
