<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
    <div class="absolute inset-0 mesh-gradient opacity-30 dark:opacity-20"></div>
    <div class="absolute top-40 left-10 w-96 h-96 bg-gradient-to-br from-purple-400/30 to-pink-400/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-[float_8s_ease-in-out_infinite]"></div>
    <div class="absolute bottom-40 right-10 w-96 h-96 bg-gradient-to-br from-orange-400/30 to-red-400/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-[float_10s_ease-in-out_infinite] delay-500"></div>

    <div class="relative z-10 max-w-lg w-full px-4">
        @if(!$votingLink)
            <div class="glass rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-800/50 p-12">
                <div class="text-center mb-8">
                    <h1 class="font-display text-5xl font-extrabold text-[#1b1b18] dark:text-[#EDEDEC] mb-4">Get Your Voting Link</h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400">Enter your phone number below</p>
                </div>

                <form wire:submit.prevent="getLink">
                    <input type="tel" wire:model="phone" placeholder="Your phone number" 
                           class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-2xl px-6 py-5 text-xl text-center bg-white dark:bg-gray-900 text-[#1b1b18] dark:text-[#EDEDEC] focus:ring-2 focus:ring-[#F53003] focus:border-[#F53003] transition-all placeholder:text-gray-400 mb-3" 
                           required autofocus>
                    @error('phone') 
                        <p class="text-center text-red-500 text-sm font-medium mb-3">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="cta-button relative w-full bg-gradient-to-r from-[#F53003] to-[#FF6B35] hover:from-[#d92a02] hover:to-[#F53003] text-white px-8 py-5 rounded-2xl font-bold text-xl shadow-xl hover:shadow-2xl transition-all">
                        <span class="relative z-10">Continue</span>
                    </button>
                </form>
            </div>
        @else
            <div class="glass rounded-3xl shadow-2xl border border-gray-200/50 dark:border-gray-800/50 p-12">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-500 to-teal-600 rounded-3xl shadow-lg mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h1 class="font-display text-4xl font-extrabold text-[#1b1b18] dark:text-[#EDEDEC] mb-3">Welcome, {{ $voterName }}!</h1>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 border-2 border-green-300 dark:border-green-700 rounded-2xl p-6 mb-6">
                    <a href="{{ $votingLink }}" class="cta-button relative block w-full bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white px-8 py-5 rounded-xl font-bold text-xl text-center shadow-lg hover:shadow-xl transition-all">
                        <span class="relative z-10">Cast Your Vote</span>
                    </a>
                </div>

                <button wire:click="$set('votingLink', null)" class="w-full text-gray-600 dark:text-gray-400 hover:text-[#F53003] font-semibold transition-colors py-2">
                    ← Back
                </button>
            </div>
        @endif
    </div>
</section>
