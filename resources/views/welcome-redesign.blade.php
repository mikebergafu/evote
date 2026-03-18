<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eVoter - Secure Association Election Management</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&family=space-grotesk:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
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

            /* Smooth Scrolling */
            html {
                scroll-behavior: smooth;
            }

            /* Custom Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-60px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(60px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0) rotate(0deg);
                }
                50% {
                    transform: translateY(-20px) rotate(3deg);
                }
            }

            @keyframes gradient-shift {
                0%, 100% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
            }

            @keyframes pulse-ring {
                0% {
                    transform: scale(1);
                    opacity: 1;
                }
                100% {
                    transform: scale(1.5);
                    opacity: 0;
                }
            }

            /* Glassmorphism */
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

            /* Gradient Text */
            .gradient-text {
                background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Animated Gradient Background */
            .gradient-bg-animated {
                background: linear-gradient(-45deg, #667eea, #764ba2, #F53003, #FF6B35);
                background-size: 400% 400%;
                animation: gradient-shift 15s ease infinite;
            }

            /* Mesh Gradient */
            .mesh-gradient {
                background: radial-gradient(at 40% 20%, hsla(28,100%,74%,1) 0px, transparent 50%),
                            radial-gradient(at 80% 0%, hsla(189,100%,56%,0.3) 0px, transparent 50%),
                            radial-gradient(at 0% 50%, hsla(355,100%,93%,0.3) 0px, transparent 50%),
                            radial-gradient(at 80% 50%, hsla(340,100%,76%,0.3) 0px, transparent 50%),
                            radial-gradient(at 0% 100%, hsla(22,100%,77%,1) 0px, transparent 50%),
                            radial-gradient(at 80% 100%, hsla(242,100%,70%,0.3) 0px, transparent 50%),
                            radial-gradient(at 0% 0%, hsla(343,100%,76%,0.3) 0px, transparent 50%);
            }

            /* Card Hover Effects */
            .card-hover {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .card-hover:hover {
                transform: translateY(-12px) scale(1.02);
                box-shadow: 0 30px 60px rgba(245, 48, 3, 0.2);
            }

            /* Bento Grid */
            .bento-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1.5rem;
            }

            @media (min-width: 768px) {
                .bento-grid {
                    grid-template-columns: repeat(3, 1fr);
                    grid-template-rows: repeat(3, 1fr);
                }
                .bento-large {
                    grid-column: span 2;
                    grid-row: span 2;
                }
                .bento-tall {
                    grid-row: span 2;
                }
                .bento-wide {
                    grid-column: span 2;
                }
            }

            /* Scroll Reveal */
            .scroll-reveal {
                opacity: 0;
                transform: translateY(40px);
                transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .scroll-reveal.revealed {
                opacity: 1;
                transform: translateY(0);
            }

            /* Pulse Ring Animation */
            .pulse-ring {
                position: relative;
            }

            .pulse-ring::before {
                content: '';
                position: absolute;
                inset: -10px;
                border-radius: inherit;
                background: inherit;
                opacity: 0.5;
                animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            /* FAQ Accordion */
            .faq-item input:checked ~ .faq-answer {
                max-height: 500px;
                opacity: 1;
                padding-top: 1rem;
            }

            .faq-item input:checked ~ label svg {
                transform: rotate(180deg);
            }

            .faq-answer {
                max-height: 0;
                opacity: 0;
                overflow: hidden;
                transition: all 0.3s ease-in-out;
            }

            /* Custom Cursor Effect on CTAs */
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

            /* Delay Classes */
            .delay-100 { animation-delay: 0.1s; transition-delay: 0.1s; }
            .delay-200 { animation-delay: 0.2s; transition-delay: 0.2s; }
            .delay-300 { animation-delay: 0.3s; transition-delay: 0.3s; }
            .delay-400 { animation-delay: 0.4s; transition-delay: 0.4s; }
            .delay-500 { animation-delay: 0.5s; transition-delay: 0.5s; }
            .delay-600 { animation-delay: 0.6s; transition-delay: 0.6s; }
            .delay-700 { animation-delay: 0.7s; transition-delay: 0.7s; }
            .delay-800 { animation-delay: 0.8s; transition-delay: 0.8s; }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] antialiased">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-gray-200/50 dark:border-gray-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 md:h-20">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <svg class="w-10 h-10 text-[#F53003]" viewBox="0 0 40 40" fill="currentColor">
                                <path d="M20 4L4 12v16l16 8 16-8V12L20 4zm0 32L6 29V14l14 7 14-7v15l-14 7z"/>
                                <path d="M20 8L8 14l12 6 12-6L20 8z" opacity="0.6"/>
                            </svg>
                            <div class="absolute inset-0 bg-[#F53003] opacity-20 blur-xl rounded-full"></div>
                        </div>
                        <span class="text-2xl font-display font-bold gradient-text">eVoter</span>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center gap-8">
                        <a href="#features" class="text-sm font-medium hover:text-[#F53003] transition-colors">Features</a>
                        <a href="#how-it-works" class="text-sm font-medium hover:text-[#F53003] transition-colors">How It Works</a>
                        <a href="#security" class="text-sm font-medium hover:text-[#F53003] transition-colors">Security</a>
                        <a href="#faq" class="text-sm font-medium hover:text-[#F53003] transition-colors">FAQ</a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center gap-3">
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
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
            <!-- Animated Mesh Gradient Background -->
            <div class="absolute inset-0 mesh-gradient opacity-30 dark:opacity-20"></div>
            
            <!-- Floating 3D Elements -->
            <div class="absolute top-40 left-10 w-96 h-96 bg-gradient-to-br from-purple-400/30 to-pink-400/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-[float_8s_ease-in-out_infinite]"></div>
            <div class="absolute bottom-40 right-10 w-96 h-96 bg-gradient-to-br from-orange-400/30 to-red-400/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-[float_10s_ease-in-out_infinite] delay-500"></div>
            <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-[float_12s_ease-in-out_infinite] delay-300"></div>

            <!-- Dot Pattern -->
            <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.08]">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, currentColor 1px, transparent 0); background-size: 32px 32px;"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
                <div class="text-center max-w-5xl mx-auto">
                    <!-- Badge -->
                    <div class="scroll-reveal inline-flex items-center gap-2 px-4 py-2 glass rounded-full text-sm font-semibold mb-8 border border-[#F53003]/20">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#F53003] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#F53003]"></span>
                        </span>
                        <span class="gradient-text">Secure & Anonymous Voting Platform</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="scroll-reveal font-display text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold leading-tight mb-6 md:mb-8 delay-100">
                        <span class="block">Modern Elections</span>
                        <span class="block mt-2">for Modern</span>
                        <span class="block gradient-text mt-2">Associations</span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="scroll-reveal text-xl md:text-2xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto mb-10 md:mb-12 leading-relaxed delay-200">
                        A production-ready voting system designed for associations, clubs, and organizations. 
                        <span class="font-semibold text-gray-800 dark:text-gray-200">Secure, anonymous, and incredibly easy to use.</span>
                    </p>

                    <!-- CTA Buttons -->
                    <div class="scroll-reveal flex flex-col sm:flex-row gap-4 justify-center items-center mb-16 md:mb-20 delay-300">
                        @auth
                            <a href="{{ route('election.setup') }}" class="group cta-button relative px-8 py-4 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-2xl font-bold text-lg transition-all shadow-2xl hover:shadow-[0_20px_50px_rgba(245,48,3,0.4)] flex items-center gap-3">
                                <span class="relative z-10">Create New Election</span>
                                <svg class="relative z-10 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="{{ route('dashboard') }}" class="group px-8 py-4 glass border-2 border-gray-300 dark:border-gray-700 hover:border-[#F53003] dark:hover:border-[#F53003] rounded-2xl font-bold text-lg transition-all flex items-center gap-2">
                                View Dashboard
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="group cta-button relative px-8 py-4 md:px-10 md:py-5 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-2xl font-bold text-lg md:text-xl transition-all shadow-2xl hover:shadow-[0_20px_50px_rgba(245,48,3,0.4)] flex items-center gap-3">
                                <span class="relative z-10">Get Started Free</span>
                                <svg class="relative z-10 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="{{ route('login') }}" class="group px-8 py-4 md:px-10 md:py-5 glass border-2 border-gray-300 dark:border-gray-700 hover:border-[#F53003] dark:hover:border-[#F53003] rounded-2xl font-bold text-lg md:text-xl transition-all flex items-center gap-2">
                                Sign In
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endauth
                    </div>

                    <!-- Stats Grid -->
                    <div class="scroll-reveal grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 max-w-4xl mx-auto delay-400">
                        <div class="glass rounded-2xl p-6 text-center transform hover:scale-105 transition-transform">
                            <div class="text-4xl md:text-5xl font-display font-extrabold gradient-text mb-2">100%</div>
                            <div class="text-sm md:text-base font-medium text-gray-600 dark:text-gray-400">Anonymous</div>
                        </div>
                        <div class="glass rounded-2xl p-6 text-center transform hover:scale-105 transition-transform">
                            <div class="text-4xl md:text-5xl font-display font-extrabold gradient-text mb-2">24/7</div>
                            <div class="text-sm md:text-base font-medium text-gray-600 dark:text-gray-400">Available</div>
                        </div>
                        <div class="glass rounded-2xl p-6 text-center transform hover:scale-105 transition-transform">
                            <div class="text-4xl md:text-5xl font-display font-extrabold gradient-text mb-2">Real-time</div>
                            <div class="text-sm md:text-base font-medium text-gray-600 dark:text-gray-400">Results</div>
                        </div>
                        <div class="glass rounded-2xl p-6 text-center transform hover:scale-105 transition-transform">
                            <div class="text-4xl md:text-5xl font-display font-extrabold gradient-text mb-2">Secure</div>
                            <div class="text-sm md:text-base font-medium text-gray-600 dark:text-gray-400">Device Lock</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </section>

        <!-- Features Section with Bento Grid -->
        <section id="features" class="py-24 md:py-32 bg-white dark:bg-[#161615]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16 md:mb-20">
                    <span class="scroll-reveal inline-block px-4 py-2 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] rounded-full text-sm font-bold mb-4">
                        FEATURES
                    </span>
                    <h2 class="scroll-reveal font-display text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 delay-100">
                        Everything You Need for<br />
                        <span class="gradient-text">Successful Elections</span>
                    </h2>
                    <p class="scroll-reveal text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto delay-200">
                        From setup to results, we've got you covered with powerful features designed for simplicity and security.
                    </p>
                </div>

                <!-- Bento Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    <!-- Large Feature Card -->
                    <div class="scroll-reveal md:col-span-2 md:row-span-2 card-hover glass rounded-3xl p-8 md:p-12 border border-gray-200/50 dark:border-gray-800/50 group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#F53003]/20 to-[#FF6B35]/20 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3 class="font-display text-2xl md:text-3xl font-bold mb-4">Device-Bound Security</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg mb-6 leading-relaxed">
                                Your election is locked to the device that created it. Only you can manage and conduct voting from that specific device, ensuring complete control and security.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] rounded-lg text-sm font-semibold">Device Fingerprinting</span>
                                <span class="px-3 py-1 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] rounded-lg text-sm font-semibold">Access Control</span>
                                <span class="px-3 py-1 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] rounded-lg text-sm font-semibold">Secure Setup</span>
                            </div>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="scroll-reveal delay-100 card-hover glass rounded-3xl p-8 border border-gray-200/50 dark:border-gray-800/50 group">
                        <div class="w-14 h-14 bg-purple-500/10 dark:bg-purple-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-xl font-bold mb-3">Real-time Results</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Watch results update instantly as votes come in with live analytics and turnout tracking.
                        </p>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="scroll-reveal delay-200 card-hover glass rounded-3xl p-8 border border-gray-200/50 dark:border-gray-800/50 group">
                        <div class="w-14 h-14 bg-blue-500/10 dark:bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-xl font-bold mb-3">Anonymous Voting</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Votes are cryptographically secured and never linked to voter identities. Complete privacy guaranteed.
                        </p>
                    </div>

                    <!-- Feature Card 4 -->
                    <div class="scroll-reveal delay-100 md:col-span-2 card-hover glass rounded-3xl p-8 md:p-10 border border-gray-200/50 dark:border-gray-800/50 group">
                        <div class="grid md:grid-cols-2 gap-8 items-center">
                            <div>
                                <div class="w-14 h-14 bg-green-500/10 dark:bg-green-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-display text-2xl font-bold mb-4">Easy Voter Management</h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                                    Add voters individually or in bulk. Track participation and manage voter lists with ease.
                                </p>
                                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        One vote per voter
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Unique voter IDs
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Turnout tracking
                                    </li>
                                </ul>
                            </div>
                            <div class="hidden md:block">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-green-400/20 to-blue-400/20 rounded-2xl blur-2xl"></div>
                                    <div class="relative bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-xl">
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="text-sm font-semibold text-gray-500">Voter Turnout</span>
                                            <span class="text-2xl font-bold text-green-500">87%</span>
                                        </div>
                                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                            <div class="h-full w-[87%] bg-gradient-to-r from-green-400 to-blue-500 rounded-full"></div>
                                        </div>
                                        <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                                            <div>
                                                <div class="text-2xl font-bold">347</div>
                                                <div class="text-xs text-gray-500">Voted</div>
                                            </div>
                                            <div>
                                                <div class="text-2xl font-bold">52</div>
                                                <div class="text-xs text-gray-500">Pending</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Feature Card 5 -->
                    <div class="scroll-reveal delay-200 card-hover glass rounded-3xl p-8 border border-gray-200/50 dark:border-gray-800/50 group">
                        <div class="w-14 h-14 bg-orange-500/10 dark:bg-orange-500/20 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-xl font-bold mb-3">Lightning Fast</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Modern architecture ensures blazing fast performance even with thousands of voters.
                        </p>
                    </div>

                    <!-- Feature Card 6 -->
                    <div class="scroll-reveal delay-300 md:col-span-2 card-hover glass rounded-3xl p-8 border border-gray-200/50 dark:border-gray-800/50 group">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 bg-pink-500/10 dark:bg-pink-500/20 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-display text-xl font-bold mb-3">Fully Customizable</h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    Configure election settings, add custom fields, and tailor the experience to your organization's needs. Support for multiple candidates and detailed candidate bios.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-24 md:py-32 bg-[#FDFDFC] dark:bg-[#0a0a0a] relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-5 dark:opacity-10">
                <div class="absolute top-20 left-20 w-72 h-72 bg-[#F53003] rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-72 h-72 bg-purple-500 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16 md:mb-24">
                    <span class="scroll-reveal inline-block px-4 py-2 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] rounded-full text-sm font-bold mb-4">
                        HOW IT WORKS
                    </span>
                    <h2 class="scroll-reveal font-display text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 delay-100">
                        Run Elections in<br />
                        <span class="gradient-text">4 Simple Steps</span>
                    </h2>
                    <p class="scroll-reveal text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto delay-200">
                        From creation to results, our streamlined process makes running elections effortless.
                    </p>
                </div>

                <!-- Steps Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12">
                    <!-- Step 1 -->
                    <div class="scroll-reveal relative delay-100">
                        <div class="relative group">
                            <!-- Step Number -->
                            <div class="absolute -top-6 -left-6 w-16 h-16 bg-gradient-to-br from-[#F53003] to-[#FF6B35] rounded-2xl flex items-center justify-center text-white font-display font-bold text-2xl shadow-2xl group-hover:scale-110 transition-transform z-10">
                                1
                            </div>
                            
                            <!-- Card -->
                            <div class="glass rounded-3xl p-8 pt-12 border border-gray-200/50 dark:border-gray-800/50 h-full hover:border-[#F53003]/50 transition-colors">
                                <div class="w-14 h-14 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <h3 class="font-display text-xl font-bold mb-3">Create Election</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                    Set up your election with a title, description, candidates, and time frame. The device you use here becomes the admin device.
                                </p>
                            </div>

                            <!-- Connector Line (Desktop) -->
                            <div class="hidden lg:block absolute top-8 -right-6 w-12 h-0.5 bg-gradient-to-r from-[#F53003]/50 to-transparent"></div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="scroll-reveal relative delay-200">
                        <div class="relative group">
                            <div class="absolute -top-6 -left-6 w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center text-white font-display font-bold text-2xl shadow-2xl group-hover:scale-110 transition-transform z-10">
                                2
                            </div>
                            
                            <div class="glass rounded-3xl p-8 pt-12 border border-gray-200/50 dark:border-gray-800/50 h-full hover:border-purple-500/50 transition-colors">
                                <div class="w-14 h-14 bg-purple-500/10 dark:bg-purple-500/20 rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                </div>
                                <h3 class="font-display text-xl font-bold mb-3">Add Voters</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                    Register eligible voters with unique IDs. Each voter gets a secure identifier for anonymous authentication.
                                </p>
                            </div>

                            <div class="hidden lg:block absolute top-8 -right-6 w-12 h-0.5 bg-gradient-to-r from-purple-500/50 to-transparent"></div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="scroll-reveal relative delay-300">
                        <div class="relative group">
                            <div class="absolute -top-6 -left-6 w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center text-white font-display font-bold text-2xl shadow-2xl group-hover:scale-110 transition-transform z-10">
                                3
                            </div>
                            
                            <div class="glass rounded-3xl p-8 pt-12 border border-gray-200/50 dark:border-gray-800/50 h-full hover:border-blue-500/50 transition-colors">
                                <div class="w-14 h-14 bg-blue-500/10 dark:bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <h3 class="font-display text-xl font-bold mb-3">Voters Cast Ballots</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                    Share the voting link. Voters authenticate with their ID and cast completely anonymous votes.
                                </p>
                            </div>

                            <div class="hidden lg:block absolute top-8 -right-6 w-12 h-0.5 bg-gradient-to-r from-blue-500/50 to-transparent"></div>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="scroll-reveal relative delay-400">
                        <div class="relative group">
                            <div class="absolute -top-6 -left-6 w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center text-white font-display font-bold text-2xl shadow-2xl group-hover:scale-110 transition-transform z-10">
                                4
                            </div>
                            
                            <div class="glass rounded-3xl p-8 pt-12 border border-gray-200/50 dark:border-gray-800/50 h-full hover:border-green-500/50 transition-colors">
                                <div class="w-14 h-14 bg-green-500/10 dark:bg-green-500/20 rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <h3 class="font-display text-xl font-bold mb-3">View Results</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                                    Watch real-time results and analytics as votes come in. Export reports when voting closes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom CTA -->
                <div class="scroll-reveal text-center mt-16 delay-500">
                    @auth
                        <a href="{{ route('election.setup') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-2xl font-bold text-lg transition-all shadow-lg hover:shadow-xl">
                            Start Your First Election
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-2xl font-bold text-lg transition-all shadow-lg hover:shadow-xl">
                            Get Started Free
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Security Highlight Section -->
        <section id="security" class="py-24 md:py-32 bg-gradient-to-br from-gray-900 via-[#1b1b18] to-black text-white relative overflow-hidden">
            <!-- Animated Background -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-96 h-96 bg-[#F53003]/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse delay-500"></div>
            </div>

            <!-- Grid Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: linear-gradient(#F53003 1px, transparent 1px), linear-gradient(90deg, #F53003 1px, transparent 1px); background-size: 50px 50px;"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <!-- Left Content -->
                    <div class="scroll-reveal">
                        <span class="inline-block px-4 py-2 bg-[#F53003]/20 text-[#FF6B35] rounded-full text-sm font-bold mb-6">
                            🔒 ENTERPRISE-GRADE SECURITY
                        </span>
                        <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6">
                            Security You Can
                            <span class="block gradient-text mt-2">Actually Trust</span>
                        </h2>
                        <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                            We take security seriously. Your elections are protected by multiple layers of cryptographic security and device-level authentication.
                        </p>

                        <!-- Security Features List -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-[#F53003]/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1">Device Fingerprinting</h4>
                                    <p class="text-gray-400 text-sm">Elections are bound to the device that created them using advanced fingerprinting technology.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1">Cryptographic Hashing</h4>
                                    <p class="text-gray-400 text-sm">All votes are cryptographically hashed and stored separately from voter identities.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1">One Vote Per Voter</h4>
                                    <p class="text-gray-400 text-sm">System prevents duplicate voting while maintaining complete anonymity.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold mb-1">Complete Privacy</h4>
                                    <p class="text-gray-400 text-sm">No one, not even administrators, can see how individual voters voted.</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 glass text-white border-2 border-white/20 hover:border-[#F53003] rounded-2xl font-bold transition-all">
                            Learn More About Security
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Right Visual -->
                    <div class="scroll-reveal delay-200 hidden lg:block">
                        <div class="relative">
                            <!-- 3D Lock Visual -->
                            <div class="relative glass rounded-3xl p-12 border border-white/10">
                                <div class="absolute inset-0 bg-gradient-to-br from-[#F53003]/20 to-purple-500/20 rounded-3xl blur-2xl"></div>
                                
                                <div class="relative">
                                    <!-- Central Lock Icon -->
                                    <div class="w-32 h-32 mx-auto bg-gradient-to-br from-[#F53003] to-[#FF6B35] rounded-3xl flex items-center justify-center mb-8 shadow-2xl transform hover:scale-110 transition-transform pulse-ring">
                                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>

                                    <!-- Security Badges -->
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-white/5 rounded-2xl p-4 text-center border border-white/10">
                                            <div class="text-3xl font-bold text-green-400 mb-1">256-bit</div>
                                            <div class="text-xs text-gray-400">Encryption</div>
                                        </div>
                                        <div class="bg-white/5 rounded-2xl p-4 text-center border border-white/10">
                                            <div class="text-3xl font-bold text-blue-400 mb-1">100%</div>
                                            <div class="text-xs text-gray-400">Anonymous</div>
                                        </div>
                                        <div class="bg-white/5 rounded-2xl p-4 text-center border border-white/10">
                                            <div class="text-3xl font-bold text-purple-400 mb-1">GDPR</div>
                                            <div class="text-xs text-gray-400">Compliant</div>
                                        </div>
                                        <div class="bg-white/5 rounded-2xl p-4 text-center border border-white/10">
                                            <div class="text-3xl font-bold text-orange-400 mb-1">SOC 2</div>
                                            <div class="text-xs text-gray-400">Ready</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Elements -->
                            <div class="absolute -top-6 -right-6 w-24 h-24 bg-[#F53003] rounded-2xl opacity-20 blur-2xl animate-float"></div>
                            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-purple-500 rounded-2xl opacity-20 blur-2xl animate-float delay-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-24 md:py-32 bg-white dark:bg-[#161615]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16 md:mb-20">
                    <span class="scroll-reveal inline-block px-4 py-2 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] rounded-full text-sm font-bold mb-4">
                        TESTIMONIALS
                    </span>
                    <h2 class="scroll-reveal font-display text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 delay-100">
                        Trusted by Organizations<br />
                        <span class="gradient-text">Worldwide</span>
                    </h2>
                    <p class="scroll-reveal text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto delay-200">
                        See what organizations are saying about their experience with eVoter.
                    </p>
                </div>

                <!-- Testimonials Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="scroll-reveal card-hover glass rounded-3xl p-8 border border-gray-200/50 dark:border-gray-800/50">
                        <div class="flex gap-1 mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            "eVoter transformed our annual board election. The setup was intuitive, and our members loved the anonymous voting system. Highly recommended!"
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                            <div>
                                <div class="font-bold text-sm">Jane Doe</div>
                                <div class="text-xs text-gray-500">Homeowners Association</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="scroll-reveal card-hover glass rounded-3xl p-8 border border-gray-200/50 dark:border-gray-800/50 delay-100">
                        <div class="flex gap-1 mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            "The device security feature gives us peace of mind. We ran our club's leadership election with 300+ members without a single issue."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-full flex items-center justify-center text-white font-bold">
                                MS
                            </div>
                            <div>
                                <div class="font-bold text-sm">Michael Smith</div>
                                <div class="text-xs text-gray-500">Sports Club President</div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="scroll-reveal card-hover glass rounded-3xl p-8 border border-gray-200/50 dark:border-gray-800/50 delay-200">
                        <div class="flex gap-1 mb-4">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            "Perfect for our student organization. The real-time results feature kept everyone engaged, and the mobile experience was flawless."
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-400 rounded-full flex items-center justify-center text-white font-bold">
                                SJ
                            </div>
                            <div>
                                <div class="font-bold text-sm">Sarah Johnson</div>
                                <div class="text-xs text-gray-500">Student Council</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section id="faq" class="py-24 md:py-32 bg-[#FDFDFC] dark:bg-[#0a0a0a]">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <span class="scroll-reveal inline-block px-4 py-2 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] rounded-full text-sm font-bold mb-4">
                        FAQ
                    </span>
                    <h2 class="scroll-reveal font-display text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 delay-100">
                        Frequently Asked
                        <span class="block gradient-text mt-2">Questions</span>
                    </h2>
                    <p class="scroll-reveal text-xl text-gray-600 dark:text-gray-400 delay-200">
                        Everything you need to know about eVoter
                    </p>
                </div>

                <!-- FAQ Accordion -->
                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <div class="scroll-reveal faq-item glass rounded-2xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden">
                        <input type="checkbox" id="faq1" class="peer hidden">
                        <label for="faq1" class="flex items-center justify-between p-6 cursor-pointer">
                            <span class="font-display font-bold text-lg">How secure is the voting system?</span>
                            <svg class="w-6 h-6 text-[#F53003] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </label>
                        <div class="faq-answer px-6 pb-6 text-gray-600 dark:text-gray-400">
                            <p>eVoter uses enterprise-grade security including device fingerprinting, cryptographic hashing, and complete vote anonymization. Elections are bound to the device that created them, and votes are stored with cryptographic hashes that cannot be linked back to individual voters. The system prevents duplicate voting while maintaining complete anonymity.</p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="scroll-reveal faq-item glass rounded-2xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden delay-100">
                        <input type="checkbox" id="faq2" class="peer hidden">
                        <label for="faq2" class="flex items-center justify-between p-6 cursor-pointer">
                            <span class="font-display font-bold text-lg">Can voters see results before voting?</span>
                            <svg class="w-6 h-6 text-[#F53003] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </label>
                        <div class="faq-answer px-6 pb-6 text-gray-600 dark:text-gray-400">
                            <p>No. Results are only visible to the election administrator (on the device that created the election). Voters can only cast their vote and receive confirmation. Results can be made public after voting closes if desired.</p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="scroll-reveal faq-item glass rounded-2xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden delay-200">
                        <input type="checkbox" id="faq3" class="peer hidden">
                        <label for="faq3" class="flex items-center justify-between p-6 cursor-pointer">
                            <span class="font-display font-bold text-lg">What happens if I lose access to my admin device?</span>
                            <svg class="w-6 h-6 text-[#F53003] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </label>
                        <div class="faq-answer px-6 pb-6 text-gray-600 dark:text-gray-400">
                            <p>The device that creates an election is permanently bound to that election as a security measure. If you lose access to that device, you won't be able to manage that specific election. We recommend using a secure, dedicated device for creating elections that you have reliable access to.</p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="scroll-reveal faq-item glass rounded-2xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden delay-300">
                        <input type="checkbox" id="faq4" class="peer hidden">
                        <label for="faq4" class="flex items-center justify-between p-6 cursor-pointer">
                            <span class="font-display font-bold text-lg">How many voters can participate in an election?</span>
                            <svg class="w-6 h-6 text-[#F53003] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </label>
                        <div class="faq-answer px-6 pb-6 text-gray-600 dark:text-gray-400">
                            <p>There's no hard limit on the number of voters. The system is designed to handle elections from small committees with a dozen voters to large organizations with thousands of members. Performance remains fast and reliable at any scale.</p>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="scroll-reveal faq-item glass rounded-2xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden delay-400">
                        <input type="checkbox" id="faq5" class="peer hidden">
                        <label for="faq5" class="flex items-center justify-between p-6 cursor-pointer">
                            <span class="font-display font-bold text-lg">Can voters vote from any device?</span>
                            <svg class="w-6 h-6 text-[#F53003] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </label>
                        <div class="faq-answer px-6 pb-6 text-gray-600 dark:text-gray-400">
                            <p>Yes! Voters can cast their ballot from any device with a web browser - desktop, tablet, or mobile. Only the election administrator device is restricted (the device that created the election).</p>
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="scroll-reveal faq-item glass rounded-2xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden delay-500">
                        <input type="checkbox" id="faq6" class="peer hidden">
                        <label for="faq6" class="flex items-center justify-between p-6 cursor-pointer">
                            <span class="font-display font-bold text-lg">Is there a cost to use eVoter?</span>
                            <svg class="w-6 h-6 text-[#F53003] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </label>
                        <div class="faq-answer px-6 pb-6 text-gray-600 dark:text-gray-400">
                            <p>Get started free! Create an account and run your first election at no cost. We believe every organization should have access to secure, professional voting systems.</p>
                        </div>
                    </div>
                </div>

                <!-- Still Have Questions CTA -->
                <div class="scroll-reveal text-center mt-12 delay-600">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Still have questions?</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3 text-[#F53003] hover:text-[#d92a02] font-semibold transition-colors">
                        Contact Support
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-24 md:py-32 bg-gradient-to-br from-[#F53003] to-[#FF6B35] text-white relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="scroll-reveal">
                    <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6">
                        Ready to Modernize<br />Your Elections?
                    </h2>
                    <p class="text-xl md:text-2xl text-white/90 mb-10 leading-relaxed">
                        Join organizations worldwide using eVoter for secure, anonymous, and effortless elections.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('election.setup') }}" class="cta-button relative px-10 py-5 bg-white text-[#F53003] rounded-2xl font-bold text-xl transition-all shadow-2xl hover:shadow-[0_20px_50px_rgba(0,0,0,0.3)] hover:scale-105 inline-flex items-center gap-3">
                                <span class="relative z-10">Create Your First Election</span>
                                <svg class="relative z-10 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="cta-button relative px-10 py-5 bg-white text-[#F53003] rounded-2xl font-bold text-xl transition-all shadow-2xl hover:shadow-[0_20px_50px_rgba(0,0,0,0.3)] hover:scale-105 inline-flex items-center gap-3">
                                <span class="relative z-10">Get Started Free</span>
                                <svg class="relative z-10 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="{{ route('login') }}" class="px-10 py-5 border-2 border-white/30 hover:border-white hover:bg-white/10 rounded-2xl font-bold text-xl transition-all inline-flex items-center gap-2">
                                Sign In
                            </a>
                        @endauth
                    </div>
                    <p class="mt-6 text-white/80 text-sm">No credit card required • Setup in minutes • Cancel anytime</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white dark:bg-[#161615] border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                    <!-- Company Info -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <svg class="w-10 h-10 text-[#F53003]" viewBox="0 0 40 40" fill="currentColor">
                                <path d="M20 4L4 12v16l16 8 16-8V12L20 4zm0 32L6 29V14l14 7 14-7v15l-14 7z"/>
                                <path d="M20 8L8 14l12 6 12-6L20 8z" opacity="0.6"/>
                            </svg>
                            <span class="text-2xl font-display font-bold gradient-text">eVoter</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4">
                            Modern elections for modern associations. Secure, anonymous, and incredibly easy to use.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center hover:border-[#F53003] transition-colors border border-gray-200 dark:border-gray-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center hover:border-[#F53003] transition-colors border border-gray-200 dark:border-gray-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.840 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.430.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center hover:border-[#F53003] transition-colors border border-gray-200 dark:border-gray-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Product Links -->
                    <div>
                        <h4 class="font-display font-bold mb-4">Product</h4>
                        <ul class="space-y-3">
                            <li><a href="#features" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Features</a></li>
                            <li><a href="#security" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Security</a></li>
                            <li><a href="#how-it-works" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">How It Works</a></li>
                            <li><a href="#faq" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">FAQ</a></li>
                        </ul>
                    </div>

                    <!-- Company Links -->
                    <div>
                        <h4 class="font-display font-bold mb-4">Company</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">About Us</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Blog</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Careers</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Legal Links -->
                    <div>
                        <h4 class="font-display font-bold mb-4">Legal</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Terms of Service</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">Cookie Policy</a></li>
                            <li><a href="#" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] transition-colors text-sm">GDPR</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="pt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        © {{ date('Y') }} eVoter. All rights reserved.
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Made with ❤️ for democratic organizations
                    </p>
                </div>
            </div>
        </footer>

        <!-- Scroll Reveal Script -->
        <script>
            // Intersection Observer for Scroll Animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, observerOptions);

            // Observe all scroll-reveal elements
            document.addEventListener('DOMContentLoaded', () => {
                const scrollElements = document.querySelectorAll('.scroll-reveal');
                scrollElements.forEach(el => observer.observe(el));
            });
        </script>
    </body>
</html>
