@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                @foreach ($users as $user)
                    <a href="/user/{{ $user->id }}" class="media">
                        <div class="media-left">
                            <img src="https://api.adorable.io/avatars/80/{{ $user->name }}.png" class="media-object" style="width:80px; border-radius:50%;margin-bottom: 1rem;">
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading title">{{ $user->name }}</h2>
                        </div>
                    </a>
                @endforeach
                ヽ(*・ω・)ﾉ
                </div>
            </div>
        </div>
    </div>
</div>
@endsection