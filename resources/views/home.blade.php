@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Новый комментарий</div>

                <div class="panel-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error) 
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session('success') }}</li>
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('new_comment') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="subject">Заголовок</label>
                            <input class="form-control" type="text" name="subject" id="subject">
                            <label for="theme">Тема</label>
                            <input class="form-control" type="text" name="theme" id="theme">
                            <label for="message">Текст комментария</label>
                            <textarea class="form-control" name="message" id="message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Комментарии</div>

                <div class="panel-body">
                    @foreach ($data as $comment)
                    <div class="media">
                        <div class="media-body">
                            <h2 class="media-heading title">{{ $comment->subject }}</h2>
                            <h4 class="media-heading">{{ $comment->theme }}</h4>
                            <p class="comment">
                                {{ $comment->message }}<br>
                                <a href="#">reply</a>
                            </p>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    ヽ(*・ω・)ﾉ
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
