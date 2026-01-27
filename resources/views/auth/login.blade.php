@extends('layouts.app')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center px-4 py-12 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-600/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 1s;"></div>

        <div
            class="max-w-md w-full space-y-8 bg-gray-900/40 backdrop-blur-xl p-8 rounded-3xl border border-white/10 shadow-2xl relative z-10 transform transition-all duration-500 hover:scale-[1.01]">
            <div class="text-center">
                <!-- Logo Section -->
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="relative w-24 h-24 group">
                        <div
                            class="absolute inset-0 bg-blue-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition-opacity duration-500">
                        </div>
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Anime Santuy"
                            class="relative w-24 h-24 object-cover rounded-2xl transform transition-transform duration-500 hover:rotate-12">
                    </div>
                    <h2 class="text-3xl font-black font-['Orbitron'] tracking-tighter text-white uppercase italic">
                        <span class="text-blue-500">Anime</span>Santuy
                    </h2>
                    <p class="mt-2 text-sm text-gray-400 font-medium">Selamat datang kembali! Masuk ke akunmu.</p>
                </div>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-300 ml-1 mb-1">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 group-focus-within:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full pl-10 pr-3 py-3 bg-gray-800/50 border border-gray-700/50 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300"
                                placeholder="nama@email.com" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-300 ml-1 mb-1">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 group-focus-within:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="block w-full pl-10 pr-3 py-3 bg-gray-800/50 border border-gray-700/50 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-500/10 border border-red-500/50 p-4 rounded-xl">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-400 font-medium">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 bg-gray-800 border-gray-700 rounded text-blue-600 focus:ring-blue-500/50">
                        <label for="remember" class="ml-2 block text-sm text-gray-400">Ingat saya</label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-black text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl hover:shadow-[0_0_20px_rgba(37,99,235,0.4)] transform hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 uppercase tracking-widest font-['Orbitron']">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-400">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="font-bold text-blue-400 hover:text-blue-300 transition-colors">Daftar di sini</a>
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