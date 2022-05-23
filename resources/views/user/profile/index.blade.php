@push('scripts')
    <script>
        let flashdatasukses = $('.success-session').data('flashdata');
        if (flashdatasukses) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: flashdatasukses,
                type: 'success'
            })
        }
        let flashdatadanger = $('.danger-session').data('flashdata');
        if (flashdatadanger) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: flashdatadanger,
                type: 'error'
            })
        }
    </script>
@endpush
<x-template-layout>
    <div class="container-fluid my-3 py-3">
        <div class="row mb-5">
            <h3 class="mb-3">Profile Setting</h3>
            @if (session('success'))
                <div class="success-session" data-flashdata="{{ session('success') }}"></div>
            @elseif(session('danger'))
                <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
            @endif
            <div class="col-lg-3">
                <div class="card position-sticky top-1">
                    <ul class="nav flex-column bg-white border-radius-lg p-3">
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#basic-info">
                                <div class="icon me-2">
                                    <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 44"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>document</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(154.000000, 300.000000)">
                                                        <path class="color-background"
                                                            d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                            opacity="0.603585379"></path>
                                                        <path class="color-background"
                                                            d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="text-sm">Basic Info</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#password">
                                <div class="icon me-2">
                                    <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 42 42"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>box-3d-50</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(603.000000, 0.000000)">
                                                        <path class="color-background"
                                                            d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                        </path>
                                                        <path class="color-background"
                                                            d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                            opacity="0.7"></path>
                                                        <path class="color-background"
                                                            d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                            opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="text-sm">Change Password</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#sessions">
                                <div class="icon me-2">
                                    <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 40 40"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>settings</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(304.000000, 151.000000)">
                                                        <polygon class="color-background" opacity="0.596981957"
                                                            points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                        </polygon>
                                                        <path class="color-background"
                                                            d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"
                                                            opacity="0.596981957"></path>
                                                        <path class="color-background"
                                                            d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="text-sm">Sessions</span>
                            </a>
                        </li>
                        <li class="nav-item pt-2">
                            <a class="nav-link text-body" data-scroll="" href="#delete">
                                <div class="icon me-2">
                                    <svg class="text-dark mb-1" width="16px" height="16px" viewBox="0 0 45 40"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>shop </title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                                fill-rule="nonzero">
                                                <g transform="translate(1716.000000, 291.000000)">
                                                    <g transform="translate(0.000000, 148.000000)">
                                                        <path class="color-background"
                                                            d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"
                                                            opacity="0.598981585"></path>
                                                        <path class="color-foreground"
                                                            d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span class="text-sm">Delete Account</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 mt-lg-0 mt-4">
                <div class="card" id="basic-info">
                    <div class="card-header">
                        <h5>Basic Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Nama</label>
                                    <div class="input-group">
                                        <input id="name" name="name" class="form-control" type="text"
                                            value="{{ auth()->user()->name }}" required="required"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <input id="email" name="email" class="form-control" type="email"
                                            value="{{ auth()->user()->email }}" required="required"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <button class="btn bg-gradient-dark btn-sm float-end mt-3 mb-0">Update Profile</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4" id="password">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="" method="POST">
                            @csrf
                            <label class="form-label">Current password</label>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Current password"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                            <label class="form-label">New password</label>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="New password"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                            <label class="form-label">Confirm new password</label>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Confirm password"
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                            <h5 class="mt-5">Password requirements</h5>
                            <ul class="text-muted ps-4 mb-0 float-start">
                                <li>
                                    <span class="text-sm">Mininal 8 karakter</span>
                                </li>
                            </ul>
                            <button class="btn bg-gradient-dark btn-sm float-end mt-3 mb-0">Update password</button>
                        </form>

                    </div>
                </div>

                <div class="card mt-4" id="sessions">
                    <div class="card-header pb-3">
                        <h5>Sessions</h5>
                        <p class="text-sm">This is a list of devices that have logged into your account. Remove
                            those that you do not recognize.</p>
                    </div>
                    <div class="card-body pt-0">
                        @foreach ($sessions as $session)
                            <div class="d-flex align-items-center">
                                <div class="text-center w-5">
                                    @if ($session->agent->isDesktop())
                                        <i class="fas fa-desktop text-lg opacity-6" aria-hidden="true"></i>
                                    @else
                                        <i class="fas fa-mobile text-lg opacity-6" aria-hidden="true"></i>
                                    @endif
                                </div>
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <p class=" mb-1">
                                            {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown' }}
                                            -
                                            {{ $session->agent->browser() ? $session->agent->browser() : 'Unknown' }}
                                        </p>
                                        <p class="mb-0 fw-bold">
                                            {{ $session->ip_address }} -

                                            @if ($session->is_current_device)
                                                <span class="text-success">Current Device</span>
                                            @else
                                                {{ __('Last active') }} {{ $session->last_active }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <span class="badge badge-success badge-sm my-auto ms-auto me-3">Active</span>
                                <button class="btn btn-sm bg-gradient-danger mb-0" type=" button" name="button">Delete
                                    Session</button>
                            </div>
                            <hr class="horizontal dark">
                        @endforeach


                    </div>
                </div>

                <div class="card mt-4" id="delete">
                    <div class="card-header">
                        <h5>Delete Account</h5>
                        <p class="text-sm mb-0">Once you delete your account, there is no going back. Please be
                            certain.</p>
                    </div>
                    <div class="card-body d-sm-flex pt-0">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div>
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault0">
                                </div>
                            </div>
                            <div class="ms-2">
                                <span class="text-dark font-weight-bold d-block text-sm">Confirm</span>
                                <span class="text-xs d-block">I want to delete my account.</span>
                            </div>
                        </div>
                        <button class="btn bg-gradient-danger mb-0 ms-auto" type="button" name="button">Delete
                            Account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template-layout>
