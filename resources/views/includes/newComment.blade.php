<form action="{{ route('new_comment') }}" method="post">
    {{ csrf_field() }}
    @if (isset($id))
        <input type="hidden" name="user_id" value="{{ $id }}">
    @endif
    @if (isset($parent_id))
        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
    @endif
    <div class="form-group">
        <label for="subject">Заголовок</label>
        <input class="form-control" type="text" name="subject" id="subject">
        <label for="message">Текст комментария</label>
        <textarea class="form-control" name="message" id="message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>