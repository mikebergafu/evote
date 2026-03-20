<x-layouts::app :title="__('Settings')">
    <div class="p-4 sm:p-6">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-3xl border border-gray-200 bg-gradient-to-br from-white to-gray-50 p-6 shadow-sm dark:border-gray-700 dark:from-gray-800 dark:to-gray-900">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Settings</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage account preferences and platform controls from one place.</p>
            </div>

            <div class="rounded-3xl border border-gray-200 bg-white shadow-xl dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
                <div class="border-b border-gray-200 p-4 dark:border-gray-700">
                    <nav class="flex flex-wrap gap-2" aria-label="Settings tabs">
                        <button onclick="showTab('user')" id="tab-user" class="tab-button active rounded-xl px-4 py-2 text-sm font-semibold bg-blue-600 text-white shadow-sm">
                            User Settings
                        </button>
                        @if(auth()->user()->role === 'admin')
                            <button onclick="showTab('system')" id="tab-system" class="tab-button rounded-xl px-4 py-2 text-sm font-semibold bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                System Settings
                            </button>
                        @endif
                    </nav>
                </div>

                <div class="p-4 sm:p-6">
                    <div id="content-user" class="tab-content space-y-8">
                        <div class="rounded-2xl border border-gray-200 bg-gray-50/60 p-5 dark:border-gray-700 dark:bg-gray-900/30">
                            <livewire:settings.profile />
                        </div>

                        <div class="rounded-2xl border border-gray-200 bg-gray-50/60 p-5 dark:border-gray-700 dark:bg-gray-900/30">
                            <livewire:settings.security />
                        </div>

                        <div class="rounded-2xl border border-gray-200 bg-gray-50/60 p-5 dark:border-gray-700 dark:bg-gray-900/30">
                            <livewire:settings.appearance />
                        </div>
                    </div>

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
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(el => {
                el.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-sm');
                el.classList.add('bg-gray-100', 'text-gray-700', 'dark:bg-gray-700', 'dark:text-gray-300');
            });

            document.getElementById('content-' + tab).classList.remove('hidden');
            const button = document.getElementById('tab-' + tab);
            button.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-sm');
            button.classList.remove('bg-gray-100', 'text-gray-700', 'dark:bg-gray-700', 'dark:text-gray-300');
        }
    </script>
</x-layouts::app>
