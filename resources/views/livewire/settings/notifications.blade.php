<div class="rounded-2xl border border-gray-200 bg-gray-50/60 p-5 dark:border-gray-700 dark:bg-gray-900/30">
    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-5">System Settings</h2>
    
    @if(session()->has('message'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800 dark:border-green-800 dark:bg-green-900/20 dark:text-green-400">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-5">
        <!-- Voter Registration Alerts -->
        <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-3">Voter Registration Alerts</h3>
            
            <div class="mb-3 flex items-center gap-3 rounded-xl border border-blue-200 bg-blue-50 p-3 dark:border-blue-800 dark:bg-blue-900/20">
                <input type="checkbox" wire:model="alertEnabled" id="alertEnabled" class="w-5 h-5 text-blue-600 rounded">
                <label for="alertEnabled" class="text-gray-900 dark:text-white font-semibold cursor-pointer">
                    Enable SMS alerts when voters register
                </label>
            </div>

            @if($alertEnabled)
                <div>
                    <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                        Alert Phone Number
                    </label>
                    <input type="tel" wire:model="alertPhone" placeholder="+254712345678"
                           class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-gray-900 dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        You'll receive an SMS notification whenever a new voter registers for any election
                    </p>
                </div>
            @endif
        </div>

        <!-- User Registration -->
        <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-3">User Registration Control</h3>
            
            <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 p-3 dark:border-red-800 dark:bg-red-900/20">
                <input type="checkbox" wire:model="blockSelfRegistration" id="blockSelfRegistration" class="w-5 h-5 text-red-600 rounded">
                <label for="blockSelfRegistration" class="text-gray-900 dark:text-white font-semibold cursor-pointer">
                    Block normal user registration
                </label>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 ml-8">
                When enabled, new user account signup via the `/register` page is disabled. Voter registration links remain available.
            </p>
        </div>

        <button type="submit" class="rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:from-blue-600 hover:to-purple-700">
            Save Settings
        </button>
    </form>
</div>
