@component('admin.template')
@push('styles')
@endpush


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="{{ route('admin.ticket.index') }}" class="btn bg-gradient-primary">
                    <i class="fas fa-angle-left" style="font-size: 20px"></i>
                </a>
                <h4>Data Tiket</h4>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-1">
                        <label class="form-label mt-4" style="font-size: 14px">Status</label>
                    </div>
                    <div class="col-md-1">
                        <?php if ($ticket->status ==  "close") echo '<h5 class="btn bg-gradient-secondary btn-small mt-3 disabled">close</h5>'; ?>
                        <?php if ($ticket->status ==  "open") echo '<h5 class="btn bg-gradient-success btn-small mt-3 disabled">open</h5>'; ?>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-1">
                        <label class="form-label mt-2" style="font-size: 14px">Kategori</label>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mt-2" style="font-size: 14px"><?php echo htmlspecialchars_decode($ticket->category); ?></label>
                    </div>
                </div>
                <div class="row mt-5 mb-3">
                    <div class="container">
                        <div class="card">
                            <div class="card-header text-white" style="background-color: #00AA9E;">
                                By : {{$ticket->name}} <br>
                                <small>{{Carbon\Carbon::parse($ticket->updated_at)->format("d/m/Y")}}</small>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo htmlspecialchars_decode($ticket->body); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <form id="comment" action="{{ route('admin.ticket_response.store')}}" method="post">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                <?php if ($ticket->status ==  "open") echo 
                    '<div class="card-body pt-0 mt-4">
                        <div class="col-md-12">
                            <label class="form-label mt-4 h6">Masukkan Respon</label>
                            <textarea name="response" id="response" cols="30" rows="7" class="form-control" placeholder="Answer" required></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn bg-gradient-primary">Submit</button>
                        </div>
                    </div>'; 
                    ?>
            </form>
        </div>

        <div class="card-body pt-0 mt-2">
            <div class="col-md-12">
                <?php $jumlah_respon = 0; ?>
                @foreach($ticket_responses as $response)
                <?php $jumlah_respon = $jumlah_respon+1; ?>
                @endforeach
                <label class="form-label mt-4 h6">{{$jumlah_respon}} Respon</label>
            </div>
            @foreach($ticket_responses as $response)
            <div class="row mt-3">
                <div class="card border">
                    <div class="card-header pb-0" style="font-size:12px">
                        <small>{{Carbon\Carbon::parse($response->updated_at)->format("d/m/Y")}}</small>
                        <br>
                        <small>by: {{$response->name}}</small>
                    </div>
                    <div class="card-body">
                        <?php echo htmlspecialchars_decode($response->response); ?>
                    </div>
                    <form onsubmit="return confirm('Komentar Anda Akan Dihapus, Apakah Anda Yakin ?');" action="{{ route('admin.ticket_response.destroy', $response->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <?php if ($response->user_id == (auth()->user()->id)) echo
                                '<button type="submit" class="btn shadow"><i class="fas fa-trash"></i></button>' ;
                            ?>
                    </form>
                </div>
            </div>
            @endforeach
        </div>


    </div>
</div>
<script src="https://cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('response');
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.editorConfig = function(config) {
        config.language = 'es';
        config.uiColor = '#F7B42C';
        config.toolbarCanCollapse = true;
    };

</script>
@endcomponent
