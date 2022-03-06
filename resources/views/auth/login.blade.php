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
                <h4>Hello! let's get started</h4>
                <h6 class="fw-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                            autofocus />
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
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember" />
                                Keep me signed in
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="#" class="auth-link text-black">Forgot password?</a>
                        @endif
                    </div>
                    <div class="mt-3">
                        <button type="submit"
                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                    </div>

                    <div class="text-center mt-4 fw-light">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary">Create</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
