@extends('layouts.app')

@section('content')
<section class="myapp" id="index">
  <div class="container">
    <div class="menu">
      <div class="create" style="margin-top: 5px;">
        <a href="{{ route('posts.create', ['post' => $post->id]) }}">create reply</a>
      </div>
      <div class="back">
        <a href="{{ route('posts.index') }}">&larr;back</a>
      </div>
    </div>
    <div class="posts" style="margin-top: 6px;">
      <div class="post-card">
        @include('posts.post')
        <div class="replies">
          @foreach ($replies as $reply)
            @include('posts.reply')
          @endforeach
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</section>
@endsection
