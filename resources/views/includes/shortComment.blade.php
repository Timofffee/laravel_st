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
        | {{ $comment->created_at }}
        @if (Auth::check())           
            @if (Auth::user() && Auth::user()->id == $comment->owner || !isset($id))
                | <a href="/comment/delete/{{ $comment->id }}">delete</a> 
            @endif
        @endif
        </small>
        @if ($comment->quote != null)
        <div class="blockquote" style="border-left: 2px solid #aaa; padding: 0.5rem 1rem; margin: 0.5rem">
            <div class="media">
                <div class="media-left">
                    <a href="/user/{{ $comment->quote->owner }}">
                    <img src="https://api.adorable.io/avatars/20/{{ $comment->quote->username }}.png" class="media-object" style="width:20px; border-radius:50%;">
                    </a> 
                </div>
                <div class="media-body">
                    <small>
                    <a href="/user/{{ $comment->quote->owner }}"> {{ $comment->quote->username }}</a> 
                    | {{ $comment->quote->created_at }}
                    <h4 class="media-heading title">{{ $comment->quote->subject }}</h4>
                    <p class="comment">
                        {{ $comment->quote->message }}
                    </p></small>
                </div>
            </div>
        </div>
        @endif
        <h4 class="media-heading title">{{ $comment->subject }}</h4>
        <p class="comment">
            {{ $comment->message }}
        </p>
    </div>
</div>
