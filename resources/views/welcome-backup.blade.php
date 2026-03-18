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
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles -->
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
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
                    transform: translateX(-50px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes pulse-glow {
                0%, 100% {
                    box-shadow: 0 0 20px rgba(245, 48, 3, 0.3);
                }
                50% {
                    box-shadow: 0 0 40px rgba(245, 48, 3, 0.6);
                }
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-10px);
                }
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out forwards;
            }

            .animate-fade-in {
                animation: fadeIn 1s ease-out forwards;
            }

            .animate-slide-in-left {
                animation: slideInLeft 0.8s ease-out forwards;
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }

            .delay-100 { animation-delay: 0.1s; }
            .delay-200 { animation-delay: 0.2s; }
            .delay-300 { animation-delay: 0.3s; }
            .delay-400 { animation-delay: 0.4s; }
            .delay-500 { animation-delay: 0.5s; }

            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .gradient-text {
                background: linear-gradient(135deg, #F53003 0%, #FF6B35 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .step-connector::after {
                content: '';
                position: absolute;
                top: 50%;
                right: -20px;
                width: 40px;
                height: 2px;
                background: linear-gradient(90deg, #F53003 0%, transparent 100%);
            }

            @media (max-width: 768px) {
                .step-connector::after {
                    display: none;
                }
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] font-sans">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-[#FDFDFC]/90 dark:bg-[#0a0a0a]/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-2">
                        <svg class="w-8 h-8 text-[#F53003]" viewBox="0 0 40 40" fill="currentColor">
                            <path d="M20 4L4 12v16l16 8 16-8V12L20 4zm0 32L6 29V14l14 7 14-7v15l-14 7z"/>
                            <path d="M20 8L8 14l12 6 12-6L20 8z" opacity="0.6"/>
                        </svg>
                        <span class="text-xl font-bold gradient-text">eVoter</span>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-5 py-2 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#F53003] dark:hover:text-[#F53003] font-medium transition-colors">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5 dark:opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, #F53003 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>

            <!-- Gradient Orbs -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 dark:bg-purple-900 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-30 animate-float"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-orange-300 dark:bg-orange-900 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-30 animate-float delay-500"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 py-20 text-center">
                <div class="animate-fade-in-up">
                    <span class="inline-block px-4 py-2 bg-[#F53003]/10 dark:bg-[#F53003]/20 text-[#F53003] dark:text-[#FF6B35] rounded-full text-sm font-semibold mb-6">
                        ✨ Secure & Anonymous Voting Platform
                    </span>
                </div>

                <h1 class="animate-fade-in-up delay-100 text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                    Modern Elections for
                    <br />
                    <span class="gradient-text">Modern Associations</span>
                </h1>

                <p class="animate-fade-in-up delay-200 text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto mb-10">
                    A production-ready voting system designed for associations, clubs, and organizations. 
                    Secure, anonymous, and incredibly easy to use.
                </p>

                <div class="animate-fade-in-up delay-300 flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @auth
                        <a href="{{ route('election.setup') }}" class="group px-8 py-4 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-xl font-semibold text-lg transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                            Create New Election
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 border-2 border-gray-300 dark:border-gray-700 hover:border-[#F53003] dark:hover:border-[#F53003] rounded-xl font-semibold text-lg transition-all">
                            View Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="group px-8 py-4 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-xl font-semibold text-lg transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                            Get Started Free
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-gray-300 dark:border-gray-700 hover:border-[#F53003] dark:hover:border-[#F53003] rounded-xl font-semibold text-lg transition-all">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Stats -->
                <div class="animate-fade-in delay-500 mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-4xl font-bold gradient-text mb-2">100%</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Anonymous Voting</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold gradient-text mb-2">24/7</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Availability</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold gradient-text mb-2">Real-time</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Results</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold gradient-text mb-2">Secure</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Device Binding</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-24 bg-white dark:bg-[#161615]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">
                        Everything You Need for
                        <span class="gradient-text">Successful Elections</span>
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        From setup to results, we've got you covered with powerful features designed for simplicity and security.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="card-hover p-8 rounded-2xl bg-[#FDFDFC] dark:bg-[#1D1D1C] border border-gray-200 dark:border-gray-800">
                        <div class="w-14 h-14 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Device-Bound Security</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Elections are bound to the device that created them. Only the setup device can manage and administer the election.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="card-hover p-8 rounded-2xl bg-[#FDFDFC] dark:bg-[#1D1D1C] border border-gray-200 dark:border-gray-800">
                        <div class="w-14 h-14 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Anonymous Voting</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Votes are stored with cryptographic hashes, completely unlinkable to voter identities. Your privacy is guaranteed.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="card-hover p-8 rounded-2xl bg-[#FDFDFC] dark:bg-[#1D1D1C] border border-gray-200 dark:border-gray-800">
                        <div class="w-14 h-14 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">One Vote Per Voter</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Advanced duplicate prevention ensures each voter can only cast one vote. System automatically tracks who has voted.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="card-hover p-8 rounded-2xl bg-[#FDFDFC] dark:bg-[#1D1D1C] border border-gray-200 dark:border-gray-800">
                        <div class="w-14 h-14 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Real-time Results</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Watch votes come in live with real-time analytics. Monitor voter turnout and view results as they happen.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="card-hover p-8 rounded-2xl bg-[#FDFDFC] dark:bg-[#1D1D1C] border border-gray-200 dark:border-gray-800">
                        <div class="w-14 h-14 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Flexible Scheduling</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Set custom start and end dates for your election. System automatically handles activation and closing.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="card-hover p-8 rounded-2xl bg-[#FDFDFC] dark:bg-[#1D1D1C] border border-gray-200 dark:border-gray-800">
                        <div class="w-14 h-14 bg-[#F53003]/10 dark:bg-[#F53003]/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Voter Management</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Easily add and manage voters with unique IDs. Track who has voted and send reminders to those who haven't.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-24 bg-[#FDFDFC] dark:bg-[#0a0a0a]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">
                        How It
                        <span class="gradient-text">Works</span>
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Set up and run your election in just a few simple steps.
                    </p>
                </div>

                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="relative text-center">
                        <div class="step-connector">
                            <div class="w-20 h-20 mx-auto bg-[#F53003] rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-[#F53003]/30">
                                <span class="text-3xl font-bold text-white">1</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Create Election</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Set up your election with name, description, and schedule. Add candidates with their information.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative text-center">
                        <div class="step-connector">
                            <div class="w-20 h-20 mx-auto bg-[#F53003] rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-[#F53003]/30">
                                <span class="text-3xl font-bold text-white">2</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Add Voters</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Register voters with unique IDs. These IDs will be used for authentication during voting.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative text-center">
                        <div class="step-connector">
                            <div class="w-20 h-20 mx-auto bg-[#F53003] rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-[#F53003]/30">
                                <span class="text-3xl font-bold text-white">3</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Activate & Share</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Activate your election and share the voting URL with all registered voters.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative text-center">
                        <div class="w-20 h-20 mx-auto bg-[#F53003] rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-[#F53003]/30">
                            <span class="text-3xl font-bold text-white">4</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Monitor Results</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Watch real-time results come in. Track turnout and view final results when election closes.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Security Section -->
        <section class="py-24 bg-gradient-to-br from-[#1b1b18] to-[#0a0a0a] text-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">
                            Security Built
                            <span class="text-[#F53003]">Into Every Layer</span>
                        </h2>
                        <p class="text-xl text-gray-400 mb-8">
                            Our multi-layered security approach ensures your elections are protected from start to finish.
                        </p>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-[#F53003]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">Device Fingerprinting</h3>
                                    <p class="text-gray-400">
                                        Elections are cryptographically bound to the device that created them using user agent, IP, and browser characteristics.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-[#F53003]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">Cryptographic Vote Hashing</h3>
                                    <p class="text-gray-400">
                                        Each vote is stored with a unique cryptographic hash that includes voter ID, timestamp, and random salt for complete anonymity.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-[#F53003]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">Access Control</h3>
                                    <p class="text-gray-400">
                                        Only the authorized setup device can access election management, voting booth, and results pages.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="bg-gradient-to-br from-[#F53003]/20 to-transparent rounded-3xl p-8 border border-[#F53003]/30">
                            <div class="bg-[#1D1D1C] rounded-2xl p-6 space-y-4">
                                <div class="flex items-center gap-3 pb-4 border-b border-gray-800">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-gray-500 ml-2">Security Verification</span>
                                </div>
                                <div class="space-y-3 font-mono text-sm">
                                    <div class="flex items-center gap-3 text-green-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span>Device fingerprint verified</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-green-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span>Vote hash generated</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-green-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span>Voter authentication passed</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-green-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span>Vote recorded anonymously</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        <span>Encryption: AES-256</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-white dark:bg-[#161615]">
            <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Ready to Run Your
                    <span class="gradient-text">First Election?</span>
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 mb-10 max-w-2xl mx-auto">
                    Join associations and organizations using eVoter for secure, transparent, and efficient elections.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @auth
                        <a href="{{ route('election.setup') }}" class="group px-8 py-4 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-xl font-semibold text-lg transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                            Create Your Election
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 border-2 border-gray-300 dark:border-gray-700 hover:border-[#F53003] dark:hover:border-[#F53003] rounded-xl font-semibold text-lg transition-all">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="group px-8 py-4 bg-[#F53003] hover:bg-[#d92a02] text-white rounded-xl font-semibold text-lg transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                            Get Started Now
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 border-2 border-gray-300 dark:border-gray-700 hover:border-[#F53003] dark:hover:border-[#F53003] rounded-xl font-semibold text-lg transition-all">
                            Sign In to Account
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 bg-[#FDFDFC] dark:bg-[#0a0a0a] border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-6 h-6 text-[#F53003]" viewBox="0 0 40 40" fill="currentColor">
                            <path d="M20 4L4 12v16l16 8 16-8V12L20 4zm0 32L6 29V14l14 7 14-7v15l-14 7z"/>
                            <path d="M20 8L8 14l12 6 12-6L20 8z" opacity="0.6"/>
                        </svg>
                        <span class="font-bold text-[#1b1b18] dark:text-[#EDEDEC]">eVoter</span>
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        &copy; {{ date('Y') }} eVoter. Secure Association Election Management.
                    </div>
                    <div class="flex items-center gap-6 text-sm">
                        <a href="https://laravel.com/docs" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] dark:hover:text-[#F53003] transition-colors">
                            Documentation
                        </a>
                        <a href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-[#F53003] dark:hover:text-[#F53003] transition-colors">
                            GitHub
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
