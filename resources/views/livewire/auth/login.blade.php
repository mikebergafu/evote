<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <!-- Branding Header -->
        <div class="text-center mb-2">
            <div class="inline-flex items-center justify-center w-20 h-20 mb-4 rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 shadow-2xl transform hover:scale-105 transition-transform duration-300">
                <x-app-logo-icon class="w-12 h-12 fill-white" />
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-zinc-900 to-zinc-700 dark:from-white dark:to-zinc-300 bg-clip-text text-transparent">Welcome Back</h1>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">Sign in to access your voting dashboard</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <flux:input
                    name="email"
                    :label="__('Email address')"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="transition-all focus:ring-2 focus:ring-blue-500"
                />
            </div>

            <!-- Password -->
            <div class="relative space-y-2">
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Enter your password')"
                    viewable
                    class="transition-all focus:ring-2 focus:ring-blue-500"
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors font-medium" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me & Security Notice -->
            <div class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg">
                <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />
                <div class="flex items-center gap-1.5 text-xs text-green-600 dark:text-green-400 font-medium">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Secure</span>
                </div>
            </div>

            <flux:button variant="primary" type="submit" class="w-full mt-2 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-all hover:shadow-xl transform hover:-translate-y-0.5 duration-200" data-test="login-button">
                <span class="flex items-center justify-center gap-2">
                    {{ __('Sign in') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </span>
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
