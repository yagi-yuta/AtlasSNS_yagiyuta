@extends('layouts.login')

@section('content')
<div>
  <div class="followers-list">
    <div class="users-icon">
      <h2 class="followers-title">フォローリスト</h2>
      @foreach($followingUsers as $user)
      @if($user->id !== Auth::id())
      <a href="{{url('/users/profile', ($user->id))}}">

      @if ($user->images && $user->images !== 'icon1.png')
      <img class="user-icon" src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->username }}">
    @else
      <img class="user-icon" src="{{ asset('images/icon1.png') }}" alt="{{ $user->username }}">
    @endif

      </a>
    @endif
    @endforeach
    </div>
  </div>

  @if ($posts && $posts->count())

    <div class="post-wrapper">
    @foreach ($posts as $post)
    <div class="post-box">

      @if (Auth::user()->id === $post->user_id)
      <!-- ログインユーザーの場合 -->
      @if ($images !== 'icon1.png')
      <img class="user-icon" src="storage/images/{{$images}}">
    @else
      <img class="user-icon" src="images/icon1.png">
    @endif
    @else
      <!-- 他のユーザーの場合 -->
      @if ($post->user->images !== 'icon1.png')
      <img class="user-icon" src="storage/images/{{$post->user->images}}">
    @else
      <img class="user-icon" src="images/icon1.png">
    @endif
    @endif


      <div class="posts-post-area">
      <div class="posts-name-area">
      <p>{{ $post->user->username }}</p>
      </div>
      {!! nl2br(e($post->post)) !!}
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
