<div class="reply">
  @foreach ($users as $user)
    @if ($user->id == $reply->user_id)
      <p class="name">{{ $user->name }}</p>
    @endif
  @endforeach
  <p class="body">{{ $reply->body }}</p>
  <div class="detail">
    <div class="left">
      <?php $j = 0; ?>
      @for ($i = 0; $i < $count; $i++)
        <?php if ($j == 1): ?>
          @break
        <?php endif; ?>
        @foreach ($likes[$i] as $like)
          @if ($like->post_id == $reply->id)
            {!! Form::model($reply, ['route' => ['likes.destroy', $reply->id, $like->id]]) !!}
              <button type="submit">
                <i class="fas fa-thumbs-up like"></i>
              </button>
              <p class="good">{{ $reply->likes_count }}</p>
            {!! Form::close() !!}
            <?php $j = 1; ?>
          @endif
        @endforeach
      @endfor
      <?php if ($j == 0): ?>
        {!! Form::model($reply, ['route' => ['likes.store', $reply->id]]) !!}
          <button type="submit">
            <i class="fas fa-thumbs-up"></i>
          </button>
          <p class="good">{{ $reply->likes_count }}</p>
        {!! Form::close() !!}
      <?php endif; ?>
    </div>
    <p class="created right">{{ $reply->created_at }}</p>
  </div>
  @if ($reply->user_id == Auth::id())
    <div class="auth">
      <div class="edit">
        <a class="edit-btn" href="{{ route('posts.edit', ['post' => $reply->id]) }}">edit</a>
      </div>
      {!! delete_form(['posts', $reply->id]) !!}
    </div>
    <div class="clear"></div>
  @endif
  <hr color="#d593fa">
</div>
