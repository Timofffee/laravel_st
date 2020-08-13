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
            <div class="panel panel-default">
                <div class="panel-heading">Все комментарии</div>

                <div class="panel-body">
                @include('includes.alert')
                @foreach ($data as $comment)
                    @include ('includes.shortComment')
                @endforeach
                ヽ(*・ω・)ﾉ
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
