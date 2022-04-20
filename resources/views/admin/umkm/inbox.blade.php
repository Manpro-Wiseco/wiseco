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

    .border {
        border: 8px solid #666;
    }

    .round {
        border-radius: 30px;
        -webkit-border-radius: 30px;
        -moz-border-radius: 30px;

    }

    /* Right triangle placed top left flush. */
    .tri-right.border.left-top:before {
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

    .tri-right.left-top:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -20px;
        right: auto;
        top: 0px;
        bottom: auto;
        border: 22px solid;
        border-color: lightyellow transparent transparent transparent;
    }

    /* Right triangle, left side slightly down */
    .tri-right.border.left-in:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -40px;
        right: auto;
        top: 30px;
        bottom: auto;
        border: 20px solid;
        border-color: #666 #666 transparent transparent;
    }

    .tri-right.left-in:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -20px;
        right: auto;
        top: 38px;
        bottom: auto;
        border: 12px solid;
        border-color: lightyellow lightyellow transparent transparent;
    }

    /*Right triangle, placed bottom left side slightly in*/
    .tri-right.border.btm-left:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: -8px;
        right: auto;
        top: auto;
        bottom: -40px;
        border: 32px solid;
        border-color: transparent transparent transparent #666;
    }

    .tri-right.btm-left:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: 0px;
        right: auto;
        top: auto;
        bottom: -20px;
        border: 22px solid;
        border-color: transparent transparent transparent lightyellow;
    }

    /*Right triangle, placed bottom left side slightly in*/
    .tri-right.border.btm-left-in:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: 30px;
        right: auto;
        top: auto;
        bottom: -40px;
        border: 20px solid;
        border-color: #666 transparent transparent #666;
    }

    .tri-right.btm-left-in:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: 38px;
        right: auto;
        top: auto;
        bottom: -20px;
        border: 12px solid;
        border-color: lightyellow transparent transparent lightyellow;
    }

    /*Right triangle, placed bottom right side slightly in*/
    .tri-right.border.btm-right-in:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: 30px;
        bottom: -40px;
        border: 20px solid;
        border-color: #666 #666 transparent transparent;
    }

    .tri-right.btm-right-in:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: 38px;
        bottom: -20px;
        border: 12px solid;
        border-color: lightyellow lightyellow transparent transparent;
    }

    /*Right triangle, placed bottom right side slightly in*/
    .tri-right.border.btm-right:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: -8px;
        bottom: -40px;
        border: 20px solid;
        border-color: #666 #666 transparent transparent;
    }

    .tri-right.btm-right:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: 0px;
        bottom: -20px;
        border: 12px solid;
        border-color: lightyellow lightyellow transparent transparent;
    }

    /* Right triangle, right side slightly down*/
    .tri-right.border.right-in:before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: -40px;
        top: 30px;
        bottom: auto;
        border: 20px solid;
        border-color: #666 transparent transparent #666;
    }

    .tri-right.right-in:after {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        left: auto;
        right: -20px;
        top: 38px;
        bottom: auto;
        border: 12px solid;
        border-color: lightyellow transparent transparent lightyellow;
    }

    /* Right triangle placed top right flush. */
    .tri-right.border.right-top:before {
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

</style>
@endpush
<div class="card">
    <div class="chat-box card p-5" style="color:black;height: 400px; overflow: auto; background-color: rgba(173,173, 173, .7)">
        @foreach ($chats as $chat)
        <div class="<?php if ($chat->user_id == (auth()->user()->id)){echo "talk-bubble tri-right left-top";}else {
            echo "talk-bubble tri-right round border right-top";}?>">
            <div class="talktext">
                <div class="border card p-2 mb-0" style="<?php if ($chat->user_id == (auth()->user()->id)) echo"background-color: rgba(102, 220, 59  ,   .4) ";?>">
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
