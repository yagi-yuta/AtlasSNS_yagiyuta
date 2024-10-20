@extends('layouts.login')

@section('content')


<div class="users-profile-wrapper">

  <div class="users-profile-content">
    <div class="users-info-icon">
      @if ($user->images && $user->images !== 'icon1.png')
      <img class="user-icon" src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->username }}">
    @else
      <img class="user-icon" src="{{ asset('images/icon1.png') }}" alt="{{ $user->username }}">
    @endif
    </div>


    <div class="profile-info">
      <div class="info-item">
        <h1>ユーザー名　</h1>
        <h1>{{$user->username}}</h1>
      </div>


      <div class="info-item">
        <h1>自己紹介　</h1>
        <h1>{{$user->bio}}</h1>
      </div>


    </div>

    <div class="profile-button">@if (in_array($user->id, $following))

      <!--フォロー済みの処理-->
      <form action="{{route('remove_follow', ['id' => $user->id])}}" method="post">
      @csrf
      <button class="follow-remove-button">フォロー解除</button>
      </form>

    @else
      <!--未フォロー処理-->
      <form action="{{route('follow', ['id' => $user->id])}}" method="post">
      @csrf
      <button class="follow-button">フォローする</button>
      </form>
    @endif
    </div>
  </div>


</div>

@if ($posts && $posts->count())


  <div class="post-wrapper">
    @foreach ($posts as $post)
    <div class="post-box">

    @if (Auth::user()->id === $post->user_id)
    <!-- ログインユーザーの場合 -->
    @if ($images !== 'icon1.png')
    <img class="user-icon" src="{{ url('storage/images/' . $images) }}">
  @else
  <img class="user-icon" src="{{ url('images/icon1.png') }}">
@endif
  @else
  <!-- 他のユーザーの場合 -->
  @if ($post->user->images !== 'icon1.png')
    <img class="user-icon" src="{{url('storage/images/' . $post->user->images) }}">
  @else
    <img class="user-icon" src="{{ url('images/icon1.png') }}">
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



@endsection
