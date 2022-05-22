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
    <script>
        const statusSelect = document.getElementById('status')
        let value = statusSelect.options[statusSelect.selectedIndex].value;
        const displayFormByStatus = (status) => {
            if (status === "Dalam Negeri") {
                document.getElementById("dalam-negeri").classList.add("d-block");
                document.getElementById("dalam-negeri").classList.remove("d-none");
                document.getElementById("dalam-negeri").innerHTML = `
                                    <label>Province</label>
                                    <div class="input-group mb-3" id="province-input-group">
                                        <select name="province" id="province"
                                            class="form-control"
                                            required>
                                            <option>- Pilih Salah Satu -</option>
                                        </select>
                                    </div>
                                    <label>City</label>
                                    <div class="input-group mb-3" id="city-input-group">
                                        <select name="city" id="city"
                                            class="form-control"
                                            required>
                                            <option>- Pilih Salah Satu -</option>
                                        </select>
                                    </div>`;
                document.getElementById("luar-negeri").classList.add("d-none");
                document.getElementById("luar-negeri").classList.remove("d-block");
                document.getElementById("luar-negeri").innerHTML = ``;
                $.ajax({
                    url: "http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                    type: 'GET',
                    success: function(res) {
                        let provinceList = [];
                        res.forEach(element => {
                            provinceList.push({
                                "id": element.id,
                                "text": element.name
                            })
                        })
                        $('#province').select2({
                            placeholder: "- Pilih Salah Satu -",
                            data: provinceList,
                            theme: 'bootstrap-5',
                            dropdownParent: $("#province-input-group")
                        });
                    }
                });


                $("#province").change(function(e) {
                    e.preventDefault();
                    console.log($('#province').select2('data')[0].id)
                    $.ajax({
                        url: `http://www.emsifa.com/api-wilayah-indonesia/api/regencies/${$('#province').select2('data')[0].id}.json`, // http://www.emsifa.com/api-wilayah-indonesia/api/regencies/32.json
                        type: 'GET',
                        success: function(res) {
                            let responseValue = [];
                            res.forEach(element => {
                                responseValue.push({
                                    "id": element.id,
                                    "text": element.name
                                })
                            })
                            $('#city').select2({
                                placeholder: "- Pilih Salah Satu -",
                                data: responseValue,
                                theme: 'bootstrap-5',
                                dropdownParent: $("#city-input-group")
                            });
                        }
                    });
                })
            } else {
                document.getElementById("dalam-negeri").classList.add("d-none");
                document.getElementById("dalam-negeri").classList.remove("d-block");
                document.getElementById("dalam-negeri").innerHTML = ``;
                document.getElementById("luar-negeri").classList.add("d-block");
                document.getElementById("luar-negeri").classList.remove("d-none");
                document.getElementById("luar-negeri").innerHTML = `<label>Country</label>
                                    <div class="input-group mb-3" id="province-input-group">
                                        <input type="text" class="form-control" name="country" id="country"
                                            placeholder="Country" required>
                                    </div>
                                    <label>Province</label>
                                    <div class="input-group mb-3" id="province-input-group">
                                        <input type="text" class="form-control" name="province" id="province"
                                            placeholder="Province" required>
                                    </div>
                                    <label>City</label>
                                    <div class="input-group mb-3" id="city-input-group">
                                        <input type="text" class="form-control" name="city" id="city" placeholder="City"
                                            required>
                                    </div>`;
            }
        }

        displayFormByStatus(value);

        statusSelect.addEventListener('change', function(e) {
            let value = e.target.value
            displayFormByStatus(value);
        })
    </script>
@endpush
<x-template-layout>
    <div class="container-fluid my-3 py-3">
        <div class="row mb-5">
            <h3 class="mb-3">Company Setting</h3>
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
                                <span class="text-sm">Company Info</span>
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
                                <span class="text-sm">Delete Company</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 mt-lg-0 mt-4">
                <div class="card" id="basic-info">
                    <div class="card-header">
                        <h5>Company Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('company-setting.update-info') }}" method="post"
                            class="mb-5">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <input id="name" name="name" class="form-control" type="text"
                                            value="{{ $company->name }}" required="required" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <input id="email" name="email" class="form-control" type="email"
                                            value="{{ $company->email }}" required="required" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Business Type</label>
                                    <div class="input-group">
                                        <input id="business_type" name="business_type" class="form-control"
                                            type="text" value="{{ $company->business_type }}" required="required"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <input id="phone" name="phone" class="form-control" type="text"
                                            value="{{ $company->phone }}" required="required" onfocus="focused(this)"
                                            onfocusout="defocused(this)">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Address</label>
                                    <div class="input-group">
                                        <input id="address" name="address" class="form-control" type="text"
                                            value="{{ $company->address }}" required="required"
                                            onfocus="focused(this)" onfocusout="defocused(this)">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-3 mb-0">Update
                                Info</button>
                        </form>
                        <form action="" method="post" class="mt-4">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" id="status" required>
                                        <option value="">- Pilih Salah Satu -</option>
                                        <option value="Dalam Negeri" @if ($company->country == 'Indonesia') selected @endif>
                                            Dalam Negeri </option>
                                        <option value="Luar Negeri" @if ($company->country != 'Indonesia') selected @endif>
                                            Luar Negeri </option>
                                    </select>
                                </div>

                                <div id="dalam-negeri" class="d-none">

                                </div>
                                <div id="luar-negeri" class="d-none">

                                </div>
                            </div>

                            <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-3 mb-0">Update
                                Status</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-4" id="delete">
                    <div class="card-header">
                        <h5>Delete Company</h5>
                        <p class="text-sm mb-0">Once you delete your company, there is no going back. Please be
                            certain.</p>
                    </div>
                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('company-setting.destroy') }}" class="d-sm-flex">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex align-items-center mb-sm-0 mb-4">
                                <div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" required
                                            id="flexSwitchCheckDefault0">
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <span class="text-dark font-weight-bold d-block text-sm">Confirm</span>
                                    <span class="text-xs d-block">I want to delete my company.</span>
                                </div>
                            </div>
                            <button class="btn bg-gradient-danger mb-0 ms-auto" type="submit" name="button">Delete
                                Company</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template-layout>
