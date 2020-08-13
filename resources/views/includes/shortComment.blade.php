<div class="media">
    <div class="media-left">
        @if (!$comment->deleted)
        <a href="/user/{{ $comment->owner }}">
        <img src="https://api.adorable.io/avatars/40/{{ $comment->username }}.png" class="media-object" style="width:40px; border-radius:50%;">
        </a>
        @endif 
    </div>
    <div class="media-body">
        <small>
        <a href="/user/{{ $comment->owner }}"> {{ $comment->username }}</a> 
        | <a href="/comment/{{ $comment->id }}">{{ $comment->created_at }}</a>
        @if (Auth::check())           
            @if (Auth::user() && Auth::user()->id == $comment->owner || !Auth::user()->id == $comment->user_id)
                | <a href="/comment/delete/{{ $comment->id }}">delete</a> 
            @endif
        @endif
        </small>
        @if ($comment->quote != null)
        <div class="blockquote" style="border-left: 2px solid #aaa; padding: 0.5rem 1rem; margin: 0.5rem">
            @if ($comment->quote->deleted)
            <small><h4 class="media-heading title text-gray">*/ COMMENT IS DELETED /*</h4></small>
            @else
            <div class="media">
                <div class="media-left">
                    <a href="/user/{{ $comment->quote->owner }}">
                    <img src="https://api.adorable.io/avatars/20/{{ $comment->quote->username }}.png" class="media-object" style="width:20px; border-radius:50%;">
                    </a> 
                </div>
                <div class="media-body">
                    <small>
                    <a href="/user/{{ $comment->quote->owner }}"> {{ $comment->quote->username }}</a> 
                    | <a href="/comment/{{ $comment->quote->id }}">{{ $comment->quote->created_at }}</a>
                    <h4 class="media-heading title">{{ $comment->quote->subject }}</h4>
                    <p class="comment">
                        {{ $comment->quote->message }}
                    </p></small>
                </div>
            </div>
            @endif
        </div>
        @endif
        <h4 class="media-heading title">{{ $comment->subject }}</h4>
        <p class="comment">
            {{ $comment->message }}
        </p>
    </div>
</div>
