<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('ticket.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Ubah Data Tiket</h3>
                        <div class="card-body pt-0">
                            <form action="{{ route('ticket.update', $ticket->id)}}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Status</label>
                                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="" disabled selected>Status</option>
                                            <option value="open" <?php if ($ticket->status ==  "open") echo ' selected="selected"'; ?>>open</option>
                                            <option value="close" <?php if ($ticket->status ==  "close") echo ' selected="selected"'; ?>>close</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Kategori</label>
                                        <select class="form-control @error('ticket_category_id') is-invalid @enderror" name=" ticket_category" required id="ticket_category_id">
                                            <option value="" disabled selected>Kategori</option>
                                            @foreach($categories as $category_)
                                            <option value="{{ $category_->id }}" <?php if ($category_->id ==  $ticket->ticket_category_id) echo ' selected="selected"'; ?>>{{ $category_->category}}</option>
                                            @endforeach
                                        </select>
                                        @error('ticket_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label mt-4">Deskripsi</label>
                                    <textarea name="body" id="body" cols="30" rows="7" class="form-control @error('body') is-invalid @enderror" placeholder="Deskripsi" required>{{ old('body') }}{{$ticket->body}}</textarea>
                                    @error('body')
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
    </section>
</x-template-layout>

<script src="http://cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('body');
    CKEDITOR.config.allowedContent = true;

</script>
