<div class="post">
  @foreach ($users as $user)
    @if ($user->id == $post->user_id)
      <p class="name">{{ $user->name }}</p>
    @endif
  @endforeach
  <p class="body">{{ $post->body }}</p>
  <div class="detail">
    <div class="left">
      <?php $j = 0; ?>
      @for ($i = 0; $i < $count; $i++)
        <?php if ($j == 1): ?>
          @break
        <?php endif; ?>
        @foreach ($likes[$i] as $like)
          @if ($like->post_id == $post->id)
            {!! Form::model($post, ['route' => ['likes.destroy', $post->id, $like->id]]) !!}
              <button type="submit">
                <i class="fas fa-thumbs-up like"></i>
              </button>
              <p class="good">{{ $post->likes_count }}</p>
            {!! Form::close() !!}
            <?php $j = 1; ?>
          @endif
        @endforeach
      @endfor
      <?php if ($j == 0): ?>
        {!! Form::model($post, ['route' => ['likes.store', $post->id]]) !!}
          <button type="submit">
            <i class="fas fa-thumbs-up"></i>
          </button>
          <p class="good">{{ $post->likes_count }}</p>
        {!! Form::close() !!}
      <?php endif; ?>
    </div>
    <p class="created right">{{ $post->created_at }}</p>
  </div>
  @if ($post->user_id == Auth::id())
    <div class="auth">
      <div class="edit">
        <a class="edit-btn" href="{{ route('posts.edit', ['post' => $post->id]) }}">edit</a>
      </div>
      {!! delete_form(['posts', $post->id]) !!}
    </div>
    <div class="clear"></div>
  @endif
  <hr color="#d593fa">
</div>
