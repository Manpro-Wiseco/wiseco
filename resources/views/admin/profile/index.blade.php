@component('admin.template')
@push('styles')
<style>
    body {
        color: #8e9194;
        background-color: #f4f6f9;
    }

    .avatar-xl img {
        width: 110px;
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    img {
        vertical-align: middle;
        border-style: none;
    }

    .text-muted {
        color: #aeb0b4 !important;
    }

    .text-muted {
        font-weight: 300;
    }

    .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #4d5154;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #eef0f3;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

</style>
@endpush
@push('scripts')
<script>
    function myFunction() {
        var x = document.getElementById("inputPassword5");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>
@endpush
<div class="card">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <div class="my-4">
                    @foreach ($nameProfil as $profil)
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                            <div class="avatar avatar-xl">
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="..." class="avatar-img rounded-circle" />
                            </div>
                        </div>
                    </div>
                    <hr class="my-2" />
                    <form action="{{ route('admin.profile.update', $profil->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-sm-6 mb-xl-0">
                                <label for="name">Nama</label>
                                <input name="name" type="text" id="name" class="border form-control @error('name') is-invalid @enderror" value="{{$profil->name}}" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-xl-6 col-sm-6 mb-xl-0">
                                <label for="inputEmail4">Email</label>
                                <input name="email" type="email" class="border form-control @error('email') is-invalid @enderror" id="email" value="{{$profil->email}}" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4" style="text-transform: lowercase;"><small>Simpan</small></button>
                    </form>
                    <hr class="my-4" />
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-sm-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="inputPassword4">Sandi Lama</label>
                                    <input type="password" class="border form-control" id="inputPassword5" />
                                    <input style="margin-top:4px;" class="d-inline-block form-check-input" type="checkbox" onclick="myFunction()"><small> Show password</small>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="inputPassword5">Sandi Baru</label>
                                    <input type="password" class="border form-control" id="inputPassword6" />
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword6">Konfirmasi Sandi</label>
                                    <input type="password" class="border form-control" id="inputPassword7" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 mb-xl-0">
                                    <button type="submit" class="btn btn-primary mt-4" style="text-transform: lowercase;"><small>Ubah Sandi</small></button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endcomponent
