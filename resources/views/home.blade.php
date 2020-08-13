@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <img src="https://api.adorable.io/avatars/80/{{ $user->name }}.png" class="media-object" style="width:80px; border-radius:50%;">
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading title">{{ $user->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::check())
            <div class="panel panel-default">
                <div class="panel-heading">Новый комментарий</div>

                <div class="panel-body">
                    @include('includes.alert')
                    @include('includes.newComment')
                </div>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Комментарии</div>

                <div class="panel-body" id="comments">
                    @foreach ($data as $comment)
                        @include ('includes.comment')
                    @endforeach
                    @if ($count > 5)
                    <div>
                        <a href="" id="show_all_comments">Показать все комментарии</a>
                    </div>
                    @endif
                </div>
                ヽ(*・ω・)ﾉ
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('show_all_comments').addEventListener("click", function (e) {
        e.preventDefault();
        let p = document.getElementById('show_all_comments').parentNode
        p.parentNode.removeChild(p)
        $.ajax({
            url: '/api/comment/getComments?user_id=1&offset=5',
            data:'_token = <?php echo csrf_token() ?>',
            success: function(data){
                document.getElementById('comments').innerHTML += data.data;
            }
        });
    });
</script>
@endsection
