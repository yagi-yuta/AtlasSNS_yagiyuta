@extends('layouts.login')

@section('content')


<div class="users-profile-wrapper">

  <div class="users-profile-content">
    <div class="users-info-icon">
      <img class="user-icon" src="{{ asset('storage/images/' . ($user->images ?: 'icon1.png')) }}" alt="{{ $user->username }}">
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
      <button class="follow-button">フォロー</button>
      </form>
    @endif
    </div>
  </div>


</div>
@if ($posts && $posts->count())

  <div class="post-box">
    @foreach ($posts as $post)

    <p><img class="user-icon"  src="{{ asset('storage/images/' . ($post->user->images ?: 'icon1.png')) }}"alt="{{$post->user->username}}"></p>
    <div class="posts-post-area">
    <div class="posts-name-area">
      <p>{{ $post->user->username }}</p>
    </div>
    {{ $post->post }}
    </div>

    <div class="time-stamp">
    <p>{{$post->created_at->format('y-m-d h:i')}}</p>
    </div>

  @endforeach
  @endif
</div>

@endsection
