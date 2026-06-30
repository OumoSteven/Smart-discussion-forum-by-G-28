<x-guest-layout>
    <div class="auth-page-wrapper">
        <div class="auth-container">
            <h1 class="auth-title">{{ __('welcome to') }}</h1>
            
            <div class="brand-logo-group">
                <div class="logo-bubbles">
                    <svg class="bubble-back" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                    </svg>
                    <svg class="bubble-front" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                    </svg>
                </div>
                <span class="brand-name">{{ __('smart discussion forum') }}</span>
            </div>
            
            <p class="auth-subtitle">{{ __('signin to continue to you account') }}</p>

            <x-auth-session-status class="session-alert" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <x-input-label for="email" :value="__('Email address:')" class="form-label" />
                    <input id="email" 
                                  type="email" 
                                  name="email" 
                                   
                                  required 
                                  autofocus 
                                  autocomplete="username" 
                                  
                                  class="input-underline" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="form-group">
                    <div class="flex-between">
                        <x-input-label for="password" :value="__('Password:')" class="form-label" />
                        @if (Route::has('password.request'))
                            <a class="link-primary text-xs" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>
                    <input id="password" 
                                  type="password" 
                                  name="password" 
                                  required 
                                  autocomplete="new-password" 
                                   
                                  class="input-underline" />
                    <x-input-error :messages="$errors->get('password')"  class="error"/>
                </div>

                <div class="checkbox-group">
                    <input id="remember_me" type="checkbox" name="remember" class="custom-checkbox">
                    <span class="checkbox-label">{{ __('Remember') }}</span>
                </div>

                <div class="policy-block">
                    <div class="flex-start">
                        <input id="terms" type="checkbox" name="terms" required class="custom-checkbox mt-05">
                        <span class="checkbox-label">
                            {{ __('I agree to the') }} 
                            <a href="#" class="link-primary">{{ __('terms and conditions') }}</a> 
                            {{ __('and') }} 
                            <a href="#" class="link-primary">{{ __('privacy policy') }}</a>
                        </span>
                    </div>
                    <p class="policy-warning">{{ __('You must agree to our terms and conditions to access the system') }}</p>
                </div>

                <div class="form-action">
                    <button type="submit" class="btn-brutalist">
                        {{ __('Sign in') }}
                    </button>
                </div>

                <div class="auth-footer">
                    {{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="link-primary">{{ __('sign up') }}</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>