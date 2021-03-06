@component('admin.template')
@push('styles')
<style>
    /* CSS talk bubble */
    .talk-bubble {
        margin: 40px;
        display: inline-block;
        position: relative;
        height: auto;
        background-color: lightyellow;
    }

    .border-chat {
        border: 8px solid #666;
    }

    .round {
        border-radius: 30px;
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;

    }

    /* Right triangle placed top right flush. */
    .tri-right.border-chat.right-top:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: -40px;
        top: -8px;
        bottom: auto;
        border: 32px solid;
        border-color: #666 transparent transparent transparent;
    }

    .tri-right.right-top:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: -20px;
        top: 0px;
        bottom: auto;
        border: 20px solid;
        border-color: lightyellow transparent transparent transparent;
    }

    /* Left triangle placed top left flush. */
    .tri-left.border-chat.left-top:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -40px;
        right: auto;
        top: -8px;
        bottom: auto;
        border: 32px solid;
        border-color: #666 transparent transparent transparent;
    }

    .tri-left.left-top:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -20px;
        right: auto;
        top: 0px;
        bottom: auto;
        border: 20px solid;
        border-color: lightyellow transparent transparent transparent;
    }

    /* talk bubble contents */
    .talktext {
        padding: 1em;
        text-align: left;
        line-height: 1.5em;
    }

    .talktext p {
        /* remove webkit p margins */
        -webkit-margin-before: 0em;
        -webkit-margin-after: 0em;
    }

    /* custom scrollbar */
    ::-webkit-scrollbar {
        width: 20px;
    }

    ::-webkit-scrollbar-track {
        background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #ddd;
        border-radius: 20px;
        border: 6px solid transparent;
        background-clip: content-box;

    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #ddd;
    }

    #chat-box:hover::-webkit-scrollbar-thumb {
        background-color: #ddd;
        opacity: 0.9;
    }

    #chat-box {
        transition: 1s;
    }

</style>
@endpush
<a href="{{ route('admin.umkm.index') }}" class="btn bg-gradient-primary">
    <i class="fas fa-angle-left" style="font-size: 20px"></i>
</a>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div id="card" class="card">
    <div id="chat-box" class="chat-box card p-6 m-4 custom-scrollbar w3-animate-opacity" style="color:black;height: 600px; overflow: auto; background-color: rgba(173,173, 173, .7)">
        @foreach ($chats as $chat)
        <div class="<?php if ($chat->user_id == (auth()->user()->id)){echo "talk-bubble tri-right round border-chat right-top";}else {
            echo "talk-bubble tri-left round border-chat left-top";}?>">
            <div class="talktext">
                <div class="border card p-2 mb-0">
                    <div class="card-header pb-0" style="font-size:12px;>">
                        <small>{{Carbon\Carbon::parse($chat->updated_at)->format("d/m/Y")}}</small>
                        <br>
                        <small>by: {{$chat->name}}</small>
                        &nbsp;
                        <?php if ($chat->user_id == 1){ echo 
                        '<i class="fas fa-user-check"></i>';}else{
                            echo '';
                        };
                         ?>
                    </div>
                    <div class="card-body" style="overflow:auto;">
                        <?php  echo htmlspecialchars_decode($chat->chat);?>
                    </div>
                    <div style="text-align: right">
                        <?php if ($chat->user_id == (auth()->user()->id)) echo
                        '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal'.$chat->id.'">
                            <i class="fa fa-trash"></i>
                    </button>' ;
                    ?>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="myModal<?php echo $chat->id; ?>" style="text-align: center">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Notifikasi</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body center">
                                    Apakah anda yakin menghapus chat anda?
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form action="{{ route('admin.inbox.hapus', $chat->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-3">Hapus</button>
                                    </form>
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Kembali</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
