<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'eVoter - Secure Association Election Management' }}</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&family=space-grotesk:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style>
            :root {
                --primary: #F53003;
                --primary-dark: #d92a02;
                --gradient-start: #F53003;
                --gradient-end: #FF6B35;
            }

            body {
                font-family: 'Instrument Sans', sans-serif;
            }

            .font-display {
                font-family: 'Space Grotesk', sans-serif;
            }

            html {
                scroll-behavior: smooth;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0) rotate(0deg);
                }
                50% {
                    transform: translateY(-20px) rotate(3deg);
                }
            }

            .glass {
                background: rgba(253, 253, 252, 0.8);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .dark .glass {
                background: rgba(10, 10, 10, 0.8);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .gradient-text {
                background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .mesh-gradient {
                background: radial-gradient(at 40% 20%, hsla(28,100%,74%,1) 0px, transparent 50%),
                            radial-gradient(at 80% 0%, hsla(189,100%,56%,0.3) 0px, transparent 50%),
                            radial-gradient(at 0% 50%, hsla(355,100%,93%,0.3) 0px, transparent 50%),
                            radial-gradient(at 80% 50%, hsla(340,100%,76%,0.3) 0px, transparent 50%),
                            radial-gradient(at 0% 100%, hsla(22,100%,77%,1) 0px, transparent 50%),
                            radial-gradient(at 80% 100%, hsla(242,100%,70%,0.3) 0px, transparent 50%),
                            radial-gradient(at 0% 0%, hsla(343,100%,76%,0.3) 0px, transparent 50%);
            }

            .cta-button {
                position: relative;
                overflow: hidden;
            }

            .cta-button::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.2);
                transform: translate(-50%, -50%);
                transition: width 0.6s, height 0.6s;
            }

            .cta-button:hover::before {
                width: 300px;
                height: 300px;
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] antialiased">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-gray-200/50 dark:border-gray-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 md:h-20">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <svg class="w-10 h-10 text-[#F53003]" viewBox="0 0 40 40" fill="currentColor">
                                <path d="M20 4L4 12v16l16 8 16-8V12L20 4zm0 32L6 29V14l14 7 14-7v15l-14 7z"/>
                                <path d="M20 8L8 14l12 6 12-6L20 8z" opacity="0.6"/>
                            </svg>
                            <div class="absolute inset-0 bg-[#F53003] opacity-20 blur-xl rounded-full"></div>
                        </div>
                        <a href="{{ route('home') }}" class="text-2xl font-display font-bold gradient-text">eVoter</a>
                    </div>

                    <div class="flex items-center gap-3">
                        @if(!request()->routeIs('register.voter') && !request()->routeIs('public.vote') && !request()->routeIs('election.vote') && !request()->routeIs('election.results'))
                            @auth
                                <a href="{{ route('dashboard') }}" class="cta-button relative px-6 py-2.5 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl text-sm">
                                    <span class="relative z-10">Dashboard</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="hidden sm:block px-5 py-2.5 text-sm font-medium hover:text-[#F53003] transition-colors">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="cta-button relative px-6 py-2.5 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl text-sm">
                                        <span class="relative z-10">Get Started</span>
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        {{ $slot }}

        <!-- Footer -->
        <footer class="bg-white dark:bg-[#161615] border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        © {{ date('Y') }} eVoter. All rights reserved.
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Made with ❤️ for democratic organizations
                    </p>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
