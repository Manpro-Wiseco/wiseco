{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

<x-default-layout>
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                    <img src="{{ asset('assets') }}/images/logo.svg" alt="logo" />
                </div>
                @if (session('status'))
                    <div class="mb-4 fs-5 fw-bold text-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h4>Register</h4>
                <h6 class="fw-light">Register your account to continue.</h6>
                <form class="pt-3" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg  @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" placeholder="Email" required />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password" required autocomplete="current-password" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="password_confirmation"
                            name="password_confirmation" placeholder="Password Confirmation" required
                            autocomplete="new-password" />
                    </div>
                    <div class="mt-3">
                        <button type="submit"
                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                    </div>

                    <div class="text-center mt-4 fw-light">
                        Have an account?
                        <a href="{{ route('login') }}" class="text-primary">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
