@extends('layouts.login')

@section('content')

<div>
  <div class="followers-list">
    <div class="users-icon">
      <h2 class="followers-title">フォロワーリスト</h2>
      @foreach($followerUsers as $user)
      @if($user->id !== Auth::id())
      <a href="{{url('/users/profile', ($user->id))}}">
      <img class="user-icon" src="{{ asset('storage/images/' . ($user->images ?: 'icon1.png')) }}" alt="{{ $user->username }}">
      </a>
    @endif
    @endforeach
    </div>
  </div>

  @if ($posts && $posts->count())


    <div class="post-wrapper">
    @foreach ($posts as $post)
    <div class="post-box">
      <img class="user-icon" src="{{ asset('storage/images/' . ($post->user->images ?: 'icon1.png')) }}" alt="
      {{$post->user->username}}">

      <div class="posts-post-area">
      <div class="posts-name-area">
      <p>{{ $post->user->username }}</p>
      </div>
      {{ $post->post }}
      <div class="time-stamp">
      <p>{{$post->created_at->format('y-m-d h:i')}}</p>
      </div>
      </div>

    </div>
  @endforeach
    </div>

  @endif

</div>

@endsection
