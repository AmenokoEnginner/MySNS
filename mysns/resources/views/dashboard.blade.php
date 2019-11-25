@extends('layouts.app')

@section('content')
<section class="myapp" id="dashboard">
  <div class="container">
    <div class="card">
      <p class="card-header">Dashboard</p>
      <div class="card-body">
        @if (session('status'))
        <div>
          {{ session('status') }}
        </div>
        @endif
        You are logged in!
      </div>
    </div>
    <div id="link">
      <p><a href="{{ route('posts.index') }}">browse</a></p>
    </div>
  </div>
</section>
@endsection
