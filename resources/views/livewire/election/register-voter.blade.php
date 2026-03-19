<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20 pb-20">
    <div class="absolute inset-0 mesh-gradient opacity-30 dark:opacity-20"></div>
    <div class="absolute top-40 left-10 w-96 h-96 bg-gradient-to-br from-purple-400/30 to-pink-400/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-[float_8s_ease-in-out_infinite]"></div>
    <div class="absolute bottom-40 right-10 w-96 h-96 bg-gradient-to-br from-orange-400/30 to-red-400/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-[float_10s_ease-in-out_infinite] delay-500"></div>

    <div class="relative z-10 max-w-2xl w-full px-4">
        <div class="glass rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-800/50 p-8 md:p-12">
            @if(!$registered)
                <div class="mb-8">
                    <h1 class="font-display text-3xl md:text-4xl font-extrabold text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Voter Registration</h1>
                    <p class="text-gray-600 dark:text-gray-400">Register for: <strong>{{ $election->name }}</strong></p>
                    <div class="mt-4 flex items-start gap-2 text-sm text-gray-600 dark:text-gray-400 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3">
                        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p>Your registration will be reviewed and verified by the election committee before approval.</p>
                            <p class="mt-1 font-medium">Once approved, you will receive a Voter ID.</p>
                        </div>
                    </div>
                </div>

                <form wire:submit.prevent="register" class="space-y-5">
                    <div class="grid md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Title *</label>
                            <select wire:model="title" 
                                    class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-900 text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] transition-all" 
                                    required>
                                <option value="">Select</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                                <option value="Dr">Dr</option>
                                <option value="Prof">Prof</option>
                            </select>
                            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Full Name *</label>
                            <input type="text" wire:model="full_name" placeholder="Enter full name" 
                                   class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-900 text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] transition-all" 
                                   required>
                            @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Email Address *</label>
                        <input type="email" wire:model="email" placeholder="email@example.com" 
                               class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-900 text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] transition-all" 
                               required>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Mobile Number *</label>
                        <input type="tel" wire:model="mobile" placeholder="+1234567890" 
                               class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-900 text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] transition-all" 
                               required>
                        @error('mobile') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="cta-button relative w-full bg-gradient-to-r from-[#F53003] to-[#FF6B35] hover:from-[#d92a02] hover:to-[#F53003] text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl hover:shadow-2xl transition-all">
                            <span class="relative z-10">Submit Registration</span>
                        </button>
                    </div>
                </form>
            @else
                <div class="text-center py-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-500 to-teal-600 rounded-3xl shadow-lg mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-3xl font-extrabold text-[#1b1b18] dark:text-[#EDEDEC] mb-3">Registration Successful!</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">Thank you for registering. You will be notified when voting begins.</p>
                </div>
            @endif
        </div>
    </div>
</section>
