<div class="flex flex-col gap-6">

    <!-- Header -->
    <div class="text-center">
        <h2 class="text-xl font-semibold text-gray-900">Entra a tu Cuenta</h2>
        <p class="text-sm text-gray-600 mt-1">Completa el formulario para entrar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6">

    <!-- Email Address -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium text-gray-700">{{ __('Email address') }}</span>
                </label>
                <input
                    wire:model="email"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="correo@ejemplo.com"
                    class="input input-bordered w-full focus:input-primary bg-white text-gray-800"
                />
                @error('email')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium text-gray-700">{{ __('Password') }}</span>
                </label>
                <input
                    wire:model="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="input input-bordered w-full focus:input-primary bg-white text-gray-800"
                />                
            </div>     
        
            <!-- Submit Button -->
            <div class="form-control">
                <button type="submit" class="btn btn-primary w-full text-white">
                    <svg class="w-5 h- mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                     {{ __('Log in') }}
                </button>
            </div>
    </form>

    <div class="text-center">
        <span class="text-sm text-gray-600">{{ __('Already have an account?') }}</span>
        <a href="{{ route('register') }}" wire:navigate class="link link-primary text-sm font-medium ml-1">
            {{ __('Sign up') }}
        </a>
    </div>

</div>
