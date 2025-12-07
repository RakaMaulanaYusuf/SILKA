@extends('main')

@section('title', 'Login')

@section('page')
<div class="min-h-screen flex items-center justify-center px-4" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center;">
    <div class="max-w-lg w-full bg-gradient-to-br from-blue-400 to-purple-600 rounded-2xl shadow-xl p-8 space-y-6">
        <!-- Logo dan Header -->
        <div class="flex flex-col items-center justify-center space-y-2">
            <img src="{{ asset('images/logosilka22.png') }}" alt="SIAKU Logo" class="w-80 h-64">
            <p class="text-white text-lg text-center font-poppins font-semibold">Sistem Informasi Laporan Keuangan dan Akuntansi</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="space-y-4" method="POST" action="{{ route('login.post') }}">   
            @csrf         
            <div>
                <label for="username" class="block text-sm font-poppins font-medium text-white">Email</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}"
                    class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan email">
            </div>

            <div class="relative">
                <label for="password" class="block text-sm font-medium font-poppins text-white">Password</label>
                
                <div class="mt-1 relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pr-12"
                        placeholder="Masukkan password">
                    
                    <!-- Tombol ikon mata -->
                    <button 
                        type="button" 
                        onclick="togglePassword()" 
                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-600">
                        
                        <!-- Icon mata (default: hidden) -->
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
                                    -1.274 4.057-5.065 7-9.542 7 -4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <!-- Icon mata tertutup (hidden by default) -->
                        <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
                                    .567-1.802 1.587-3.39 2.917-4.608M9.88 9.88a3 3 0 104.24 4.24M6.18 6.18L3 3m18 18l-3.18-3.18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-white font-poppins font-medium">
                    Ingat saya
                </label>
            </div>

            <button 
                type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold font-poppins text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
                Login
            </button>
        </form>
    </div>
</div>
<script>
function togglePassword() {
    const input = document.getElementById('password');
    const eye = document.getElementById('eyeIcon');
    const eyeOff = document.getElementById('eyeOffIcon');

    if (input.type === "password") {
        input.type = "text";
        eye.classList.add("hidden");
        eyeOff.classList.remove("hidden");
    } else {
        input.type = "password";
        eye.classList.remove("hidden");
        eyeOff.classList.add("hidden");
    }
}
</script>
@endsection