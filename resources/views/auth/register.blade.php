<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Kasir Cafe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#FFE8B6] via-white to-[#D99D81] flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-[#FFE8B6] p-10 transition-all duration-300">

        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <img src="{{ asset('assets/logo.jpeg') }}" alt="Logo Kasir Cafe" class="h-24 w-24 object-cover rounded-full shadow-lg border-4 border-white">
        </div>

        <!-- Judul -->
        <h2 class="text-4xl font-extrabold text-[#5B913B] text-center mb-2 tracking-tight">Daftar Akun</h2>
        <p class="text-center text-gray-600 text-sm">Buat akun baru untuk login ke Kasir Cafe</p>

        <!-- Status -->
        @if (session('status'))
            <div class="mt-6 mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Register -->
        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input id="name" name="name" type="text" required autofocus
                    class="mt-1 w-full px-4 py-2 rounded-lg shadow-sm border-gray-300 focus:ring-[#5B913B] focus:border-[#5B913B]"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required
                    class="mt-1 w-full px-4 py-2 rounded-lg shadow-sm border-gray-300 focus:ring-[#5B913B] focus:border-[#5B913B]"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 w-full px-4 py-2 rounded-lg shadow-sm border-gray-300 focus:ring-[#5B913B] focus:border-[#5B913B]">
                @error('password')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="mt-1 w-full px-4 py-2 rounded-lg shadow-sm border-gray-300 focus:ring-[#5B913B] focus:border-[#5B913B]">
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit"
                    class="bg-[#5B913B] hover:bg-[#77B254] text-white font-semibold px-6 py-2 rounded-xl shadow-md transition duration-200">
                    Daftar
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#5B913B] font-semibold hover:underline">Masuk</a>
        </div>
    </div>

</body>
</html>
