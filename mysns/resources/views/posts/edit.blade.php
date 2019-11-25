@extends('layouts.app')

@section('content')
<section class="myapp" id="create">
  <div class="container">
    <h1>Edit</h1>
    @include('errors.form_errors')
    {!! Form::model($post, ['method' => 'PATCH', 'route' => ['posts.update', $post->id]]) !!}
      @include('posts.form', ['body' => $post->body, 'user_id' => $post->user_id, 'reply_post_id' => $post->reply_post_id, 'likes_count' => $post->like_count, 'submit_btn' => 'Edit Post'])
    {!! Form::close() !!}
  </div>
</section>
@endsection
