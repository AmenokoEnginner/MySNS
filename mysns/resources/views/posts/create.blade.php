@extends('layouts.app')

@section('content')
<section class="myapp" id="create">
  <div class="container">
    <h1>Create</h1>
    @include('errors.form_errors')
    {!! Form::open(['route' => 'posts.store']) !!}
      @include('posts.form', ['body' => null, 'user_id' => Auth::id(), 'reply_post_id' => $reply_post_id, 'submit_btn' => 'Create Post'])
    {!! Form::close() !!}
  </div>
</section>
@endsection
