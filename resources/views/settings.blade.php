<x-layouts::app :title="__('Settings')">
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Settings</h1>
            
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- Tabs -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex -mb-px">
                        <button onclick="showTab('user')" id="tab-user" class="tab-button active px-6 py-4 text-sm font-semibold border-b-2 border-blue-500 text-blue-600 dark:text-blue-400">
                            User Settings
                        </button>
                        @if(auth()->user()->role === 'admin')
                        <button onclick="showTab('system')" id="tab-system" class="tab-button px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                            System Settings
                        </button>
                        @endif
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- User Settings Tab -->
                    <div id="content-user" class="tab-content">
                        <livewire:settings.update-profile />
                        <div class="mt-6">
                            <livewire:settings.update-password />
                        </div>
                    </div>

                    <!-- System Settings Tab (Admin Only) -->
                    @if(auth()->user()->role === 'admin')
                    <div id="content-system" class="tab-content hidden">
                        <livewire:settings.notifications />
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(el => {
                el.classList.remove('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
                el.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400');
            });
            
            // Show selected tab
            document.getElementById('content-' + tab).classList.remove('hidden');
            const button = document.getElementById('tab-' + tab);
            button.classList.add('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
            button.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400');
        }
    </script>
</x-layouts::app>
