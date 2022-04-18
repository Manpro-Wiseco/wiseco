@component('admin.template')
<div class="card">
    <div class="chat-box card p-5" style="color:black;height: 400px; overflow: auto; background-color: rgba(173,173, 173, .7)">
        @foreach ($chats as $chat)
        <div class="border card p-2 mb-5" style="<?php if ($chat->user_id == (auth()->user()->id)) echo"background-color: rgba(102, 220, 59  ,   .4) ";?>">
            <div class="card-header pb-0" style="font-size:12px; <?php if ($chat->user_id == (auth()->user()->id)) echo"background-color: rgba(102, 220, 59  ,   .4) ";?>">
                <small>{{Carbon\Carbon::parse($chat->updated_at)->format("d/m/Y")}}</small>

                <br>
                <small>by: {{$chat->name}}</small>
            </div>
            <div class="card-body" style="<?php if ($chat->user_id == (auth()->user()->id)) echo"background-color: rgba(102, 220, 59   ,   .4) ";?>">
                <?php  echo htmlspecialchars_decode($chat->chat);?>
            </div>
            <form onsubmit="return confirm('Chat Anda Akan Dihapus, Apakah Anda Yakin ?');" action="{{ route('admin.inbox.hapus', $chat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <?php if ($chat->user_id == (auth()->user()->id)) echo
                        '<button type="submit" class="btn shadow"><i class="fas fa-trash"></i></button>' ;
                    ?>
            </form>
        </div>


        @endforeach

    </div>
    <form id="comment" action="{{ route('admin.inbox.submit')}}" method="post">
        @csrf
        <input type="hidden" name="company_id" value="{{$company->id}}">
        <div class="card-body pt-0 mt-4">
            <div class="col-md-12">
                <textarea name="chat" id="chat" cols="30" rows="7" class="form-control" placeholder="Answer" required></textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn bg-gradient-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('chat');
    CKEDITOR.config.allowedContent = true;

</script>
@endcomponent
