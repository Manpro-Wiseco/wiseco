@component('admin.template')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="{{ route('admin.ticketcategory.index') }}" class="btn bg-gradient-primary">
                    <i class="fas fa-angle-left" style="font-size: 20px"></i>
                </a>
                <h4>Buat Kategori Baru</h4>
                <div class="card-body pt-0">
                    <form action="{{ route('admin.ticketcategory.store') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label mt-4">Deskripsi</label>
                            <textarea style="padding: 5px" name="category" id="category" cols="1" rows="1" class="border form-control @error('category') is-invalid @enderror" placeholder="Deskripsi" required>{{ old('category') }}</textarea>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endcomponent
<script src="https://cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
{{-- <script>
    CKEDITOR.replace('category');
    CKEDITOR.config.allowedContent = true;

</script> --}}
