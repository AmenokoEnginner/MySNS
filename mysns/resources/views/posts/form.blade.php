<div class="form-group">
  {!! Form::textarea('body', $body, ['class' => 'body']) !!}
  {!! Form::number('user_id', $user_id, ['class' => 'hidden']) !!}
  {!! Form::number('reply_post_id', $reply_post_id, ['class' => 'hidden']) !!}
  @if ($exist_likes_count)
    {!! Form::number('likes_count', $likes_count, ['class' => 'hidden']) !!}
  @endif
  {!! Form::submit($submit_btn, ['class' => 'btn']) !!}
</div>
