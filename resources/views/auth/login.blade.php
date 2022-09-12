<x-guest-layout>
    <x-auth-card>
        <div class="card">
            <div class="login_section">
                <x-slot name="logo">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" src="{{url('images/logo/logosalama.png')}}" alt="#" />
                        </div>
                    </div>
                </x-slot>

                
                <x-auth-session-status class="mb-4" :status="session('status')" />

                
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    
                    <div>
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    
                    <div class="mt-4">
                        <x-label for="password" :value="__('Mot de passe')" />

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-button class="main_bt">
                            {{ __('Se connecter') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>