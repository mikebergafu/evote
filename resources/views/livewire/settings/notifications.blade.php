<div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">System Settings</h2>
    
    @if(session()->has('message'))
        <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-800 text-green-800 dark:text-green-400 px-6 py-4 rounded-2xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Voter Registration Alerts -->
        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Voter Registration Alerts</h3>
            
            <div class="flex items-center gap-3 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl mb-4">
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
                           class="w-full border-2 border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        You'll receive an SMS notification whenever a new voter registers for any election
                    </p>
                </div>
            @endif
        </div>

        <!-- Self Registration -->
        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Voter Registration Control</h3>
            
            <div class="flex items-center gap-3 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                <input type="checkbox" wire:model="blockSelfRegistration" id="blockSelfRegistration" class="w-5 h-5 text-red-600 rounded">
                <label for="blockSelfRegistration" class="text-gray-900 dark:text-white font-semibold cursor-pointer">
                    Block self-registration for all elections
                </label>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 ml-8">
                When enabled, voters cannot register themselves. Only admins can add voters manually.
            </p>
        </div>

        <button type="submit" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition-all">
            Save Settings
        </button>
    </form>
</div>
