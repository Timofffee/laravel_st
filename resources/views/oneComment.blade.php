@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                @if($comment)
                    @include('includes.alert')
                    @include ('includes.comment')
                @else
                <p>Кажется, комментарий удалён или никогда не существовал</p>
                @endif
                ヽ(*・ω・)ﾉ
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
