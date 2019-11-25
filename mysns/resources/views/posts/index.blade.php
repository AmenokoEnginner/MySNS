@extends('layouts.app')

@section('content')
<section class="myapp" id="index">
  <div class="container">
    <div class="menu" style="padding-top: 5px;">
      <div class="create">
        <a href="{{ route('posts.create', ['post' => 0]) }}">create post</a>
      </div>
    </div>
    @include('messages.delete_success')
    <div class="posts">
      <div class="post-card">
        @foreach ($posts as $post)
          @include('posts.post')
          <div class="replies">
            <?php $i = 0; ?>
            @foreach ($replies as $reply)
              @if ($post->id == $reply->reply_post_id)
                <?php if ($i < 1): ?>
                  @include('posts.reply')
                  <?php $i++; ?>
                <?php endif; ?>
              @endif
            @endforeach
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="exist-replies">&darr;replies</a>
          </div>
          <div class="clear"></div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection
