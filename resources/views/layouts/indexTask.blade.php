<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js','resources/css/app.css'])
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="css/Jquery-ui.min.css"> --}}
    <title>Task Manager</title>
</head>

<body>
    <header>
        <nav class="bg-gray-800 p-4">
            <div class="flex justify-between items-center">
                <!-- Navbar Brand/Logo -->
                <a href="{{ route('viewTask') }}" class="text-white font-bold text-lg">My Website</a>

                <!-- Navbar Links -->
                <div class="flex space-x-4">
                    <a href="{{ route('viewTask') }}" class="text-white hover:text-gray-300">View Task</a>
                    <a href="{{ route('createTask') }}" class="text-white hover:text-gray-300">Create Task</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @if (session()->has('success'))
            <!-- Success Message Box -->
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <span class="font-semibold">Success!</span>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @yield('content')
    </main>
    <!-- Footer -->
    {{-- <footer class="bg-gray-800 text-white p-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Website. Jose Olmedo.</p>
        </div>
    </footer> --}}
    {{-- <script src="js/jqery-ui.min.js"></script> --}}
    @stack('scripts')
</body>


</html>
