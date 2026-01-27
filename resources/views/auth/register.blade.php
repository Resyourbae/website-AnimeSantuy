@extends('layouts.app')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center px-4 py-12 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-pink-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 1s;"></div>

        <div
            class="max-w-md w-full space-y-8 bg-gray-900/40 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl relative z-10 transform transition-all duration-500 hover:scale-[1.01]">
            <div class="text-center">
                <!-- Logo Section -->
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="relative w-20 h-20 group">
                        <div
                            class="absolute inset-0 bg-pink-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition-opacity duration-500">
                        </div>
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Anime Santuy"
                            class="relative w-20 h-20 object-cover rounded-2xl transform transition-transform duration-500 hover:rotate-12">
                    </div>
                    <h2 class="text-2xl font-black font-['Orbitron'] tracking-tighter text-white uppercase italic">
                        <span class="text-pink-500">Daftar</span> Akun
                    </h2>
                    <p class="mt-2 text-sm text-gray-400 font-medium">Buat akun untuk mulai menyimpan anime favoritmu.</p>
                </div>
            </div>

            <form class="mt-8 space-y-4" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-300 ml-1 mb-1">Nama Lengkap</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-pink-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="block w-full pl-10 pr-3 py-3 bg-gray-800/50 border border-gray-700/50 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500/50 focus:border-pink-500 transition-all duration-300"
                            placeholder="Nama kamu" value="{{ old('name') }}">
                    </div>
                    @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-300 ml-1 mb-1">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-pink-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full pl-10 pr-3 py-3 bg-gray-800/50 border border-gray-700/50 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500/50 focus:border-pink-500 transition-all duration-300"
                            placeholder="nama@email.com" value="{{ old('email') }}">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-300 ml-1 mb-1">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-pink-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="block w-full pl-10 pr-3 py-3 bg-gray-800/50 border border-gray-700/50 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500/50 focus:border-pink-500 transition-all duration-300"
                            placeholder="Minimal 8 karakter">
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-semibold text-gray-300 ml-1 mb-1">Konfirmasi Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-pink-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 2.944V22m0-19.056c1.025 0 2.023.15 2.964.43M12 2.944a11.955 11.955 0 00-8.618 3.04M12 22a11.955 11.955 0 01-8.618-3.04M12 22c1.025 0 2.023-.15 2.964-.43M12 22a11.955 11.955 0 008.618-3.04" />
                            </svg>
                        </div>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="new-password" required
                            class="block w-full pl-10 pr-3 py-3 bg-gray-800/50 border border-gray-700/50 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-500/50 focus:border-pink-500 transition-all duration-300"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-black text-white bg-gradient-to-r from-pink-600 to-rose-700 rounded-xl hover:shadow-[0_0_20px_rgba(219,39,119,0.4)] transform hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 uppercase tracking-widest font-['Orbitron']">
                        Daftar Akun Baru
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="font-bold text-pink-400 hover:text-pink-300 transition-colors">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .max-w-md {
            animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
@endsection