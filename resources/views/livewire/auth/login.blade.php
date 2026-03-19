<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <div class="text-center">
            <div class="mx-auto inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-600/10 text-blue-600 dark:bg-blue-500/20 dark:text-blue-300">
                <x-app-logo-icon class="h-10 w-10 fill-current" />
            </div>
            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-100">
                {{ __('Welcome back') }}
            </h1>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Sign in to continue to your dashboard') }}
            </p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <div class="rounded-xl border border-zinc-200 bg-white p-4 shadow-xs dark:border-zinc-800 dark:bg-zinc-900">
                <flux:input
                    name="email"
                    :label="__('Email address')"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="w-full"
                />

                <div class="mt-4">
                    <div class="mb-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ __('Password') }}</span>
                        @if (Route::has('password.request'))
                            <flux:link
                                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400"
                                :href="route('password.request')"
                                wire:navigate
                            >
                                {{ __('Forgot password?') }}
                            </flux:link>
                        @endif
                    </div>

                    <flux:input
                        name="password"
                        :label="null"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('Enter your password')"
                        viewable
                        class="w-full"
                    />
                </div>
            </div>

            <div class="flex items-center justify-between rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 dark:border-zinc-800 dark:bg-zinc-900/60">
                <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />
                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-600 dark:text-emerald-400">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    {{ __('Secure sign-in') }}
                </span>
            </div>

            <flux:button
                variant="primary"
                type="submit"
                class="group w-full py-3 font-semibold"
                data-test="login-button"
            >
                <span class="flex items-center justify-center gap-2">
                    {{ __('Sign in') }}
                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </flux:button>

        </form>
    </div>
</x-layouts::auth>
