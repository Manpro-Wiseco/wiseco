@push('modals')
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-info text-gradient">Create Company</h3>
                        </div>
                        <div class="card-body">
                            <form role="form text-left">
                                <label>Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                        required>
                                </div>
                                <label>Business Type</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="business_type" id="business_type"
                                        placeholder="Business Type" required>
                                </div>
                                <label>Phone Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="Phone Number" required>
                                </div>
                                <label>Email</label>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                        value="{{ old('email') ?? auth()->user()->email }}" required>
                                </div>
                                <label>Status</label>
                                <div class="input-group mb-3">
                                    <select class="form-control" id="status" required>
                                        <option value="">- Pilih Salah Satu -</option>
                                        <option value="Dalam Negeri"> Dalam Negeri </option>
                                        <option value="Luar Negeri"> Luar Negeri </option>
                                    </select>
                                </div>

                                <div id="dalam-negeri" class="d-none">

                                </div>
                                <div id="luar-negeri" class="d-none">

                                </div>

                                <div class="text-center">
                                    <button type="submit" id="create-company"
                                        class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Create</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        const statusSelect = document.getElementById('status')
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        statusSelect.addEventListener('change', function(e) {
            let value = e.target.value
            if (value === "Dalam Negeri") {
                document.getElementById("dalam-negeri").classList.add("d-block");
                document.getElementById("dalam-negeri").classList.remove("d-none");
                document.getElementById("dalam-negeri").innerHTML = `<label>Address</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="address" id="address"
                                            placeholder="Address" required>
                                    </div>
                                    <label>Province</label>
                                    <div class="input-group mb-3" id="province-input-group">
                                        <select class="form-control" id="province" style="width: 100%" required>
                                            <option></option>
                                        </select>
                                    </div>
                                    <label>City</label>
                                    <div class="input-group mb-3" id="city-input-group">
                                        <select class="form-control" id="city" required>
                                            <option></option>
                                        </select>
                                    </div>`;
                document.getElementById("luar-negeri").classList.add("d-none");
                document.getElementById("luar-negeri").classList.remove("d-block");
                document.getElementById("luar-negeri").innerHTML = ``;
                $.ajax({
                    url: "https://dev.farizdotid.com/api/daerahindonesia/provinsi",
                    type: 'GET',
                    success: function(res) {
                        let provinceList = [];
                        res.provinsi.forEach(element => {
                            provinceList.push({
                                "id": element.id,
                                "text": element.nama
                            })
                        })
                        $('#province').select2({
                            placeholder: "- Pilih Salah Satu -",
                            data: provinceList,
                            dropdownParent: $("#province-input-group")
                        });
                    }
                });


                $("#province").change(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: `https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${$('#province').select2('data')[0].id}`,
                        type: 'GET',
                        success: function(res) {
                            let responseValue = [];
                            res.kota_kabupaten.forEach(element => {
                                responseValue.push({
                                    "id": element.id,
                                    "text": element.nama
                                })
                            })
                            $('#city').select2({
                                placeholder: "- Pilih Salah Satu -",
                                data: responseValue,
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
                                    <label>Address</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="address" id="address"
                                            placeholder="Address" required>
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
        })

        $("#create-company").click(function(e) {
            e.preventDefault();
            let status = $("#status").val();
            if (status === "Dalam Negeri") {
                $.ajax({
                    url: "{{ route('company.store') }}",
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        name: $("#name").val(),
                        business_type: $("#business_type").val(),
                        phone: $("#phone").val(),
                        email: $("#email").val(),
                        status: $("#status").val(),
                        address: $("#address").val(),
                        province: $('#province').select2('data')[0].text,
                        city: $('#city').select2('data')[0].text
                    },
                    success: function(res) {
                        console.log(res);
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: "Berhasil menambah data company!",
                                showConfirmButton: true
                            }).then((result) => {
                                location.reload()
                            })
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "{{ route('company.store') }}",
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        name: $("#name").val(),
                        business_type: $("#business_type").val(),
                        phone: $("#phone").val(),
                        email: $("#email").val(),
                        status: $("#status").val(),
                        address: $("#address").val(),
                        province: $('#province').val(),
                        city: $('#city').val(),
                        country: $("#country").val()
                    },
                    success: function(res) {
                        console.log(res);
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: "Berhasil menambah data company!",
                                showConfirmButton: true
                            }).then((result) => {
                                location.reload()
                            })
                        }
                    }
                });
            }
        })
    </script>
@endpush

<x-default-layout>
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Please select your company.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn bg-danger text-white" type="submit">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-form">
                                Create Company
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-11 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Your Company List Account</h5>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Business Type</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Status</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Country</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($companies as $company)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg"
                                                                    class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">{{ $company->name }}</h6>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ $company->email }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $company->business_type }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <p class="text-secondary text-xs font-weight-bold mb-0">
                                                            {{ $company->status }}</p>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $company->country }}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="javascript:;"
                                                            class="btn btn-sm btn-secondary fw-bold text-sm"
                                                            data-toggle="tooltip">
                                                            Open
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-default-layout>
