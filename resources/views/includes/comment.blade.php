<div class="media">
    <div class="media-left">
        @if (!$comment->deleted)
        <a href="/user/{{ $comment->owner }}">
        <img src="https://api.adorable.io/avatars/40/{{ $comment->username }}.png" class="media-object" style="width:40px; border-radius:50%;">
        </a>
        @endif 
    </div>
    <div class="media-body">
        @if ($comment->deleted)
            <h4 class="media-heading title text-gray">*/ COMMENT IS DELETED /*</h4>
            <div style="height:20px;"></div>
        @else
            <small>
            <a href="/user/{{ $comment->owner }}"> {{ $comment->username }}</a> 
            | <a href="/comment/{{ $comment->id }}">{{ $comment->created_at }}</a>
            @if (Auth::check())           
                @if (Auth::user()->id == $comment->owner || Auth::user()->id == $comment->user_id)
                    | <a href="/comment/delete/{{ $comment->id }}">delete</a> 
                @endif
            @endif
            </small>
            <h4 class="media-heading title">{{ $comment->subject }}</h4>
            <p class="comment" style="white-space: pre-line; margin: 0;">{{ $comment->message }}</p>
            @if (Auth::check() && $comment->parent_id == null)
            <a href="" id="button_reply_{{ $comment->id }}">reply</a> 
            @endif
        @endif
    </div>
</div>
@if (!$comment->deleted && $comment->parent_id == null)
<script>
    document.getElementById('button_reply_{{ $comment->id }}').addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById('reply_{{ $comment->id }}').classList.remove("hidden");
    });
</script>
<div id="reply_{{ $comment->id }}" class="hidden">
    @include ('includes.newComment', ['parent_id' => $comment->id ])
</div>
@endif
<div style="margin-left: 55px; margin-top: 15px">
    @foreach ($comment->childs as $child)
    <div class="media">
        <div class="media-left">
            <a href="/user/{{ $child->owner }}">
            <img src="https://api.adorable.io/avatars/40/{{ $child->username }}.png" class="media-object" style="width:40px; border-radius:50%;">
            </a> 
        </div>
        <div class="media-body">
            <small>
            <a href="/user/{{ $child->owner }}"> {{ $child->username }}</a> 
            | <a href="/comment/{{ $child->id }}">{{ $child->created_at }}</a>
            @if (Auth::check())
                @if (Auth::user()->id == $child->owner || Auth::user()->id == $comment->user_id)
                | <a href="/comment/delete/{{ $child->id }}">delete</a> 
                @endif
            @endif
            </small>
            <h4 class="media-heading title">{{ $child->subject }}</h4>
            <p class="comment" style="white-space: pre-line;">{{ $child->message }}</p>
        </div>
    </div>
    @endforeach
</div>