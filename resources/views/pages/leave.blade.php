@extends('layout.layout')

@section('content')
    <!-- component -->
    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

    <!-- page -->
    <main class="min-h-screen w-full bg-gray-100 text-gray-700" x-data="layout">
        <!-- header page -->
        <header class="flex w-full items-center justify-between border-b-2 border-gray-200 bg-white p-2">
            <!-- logo -->
            <div class="flex items-center space-x-2">
                <button type="button" class="text-3xl" @click="asideOpen = !asideOpen"><i class="bx bx-menu"></i></button>
                <div>Request form</div>
            </div>
        </header>

        <div class="flex">
            @include('navbar.nav')

            <!-- main content page -->
            <div class="w-full p-4 mb-5">
                <h1 class=" mb-5 form-title">Leave form</h1>
            @include('forms.leave-form')
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("layout", () => ({
                profileOpen: false,
                asideOpen: true,
            }));
        });
    </script>
@endsection
