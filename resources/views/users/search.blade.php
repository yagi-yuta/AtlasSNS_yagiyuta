@extends('layouts.login')

@section('content')



<div class="search-form-wrapper">

  <div class="search-form">
    <div class="search-input">
      <form action="/search" method="post">
        @csrf
        <input type="text" name="search" placeholder="ユーザー名" required>
    </div>

    <div>
      <button type="submit">
        <img class="button" src="/images/search.png">
      </button>
    </div>

    </form>
    @if(isset($query) && $query)
    <h2>検索ワード:{{$query}}</h2>
  @endif
  </div>

</div>

<div class="userlist">
  @foreach ($users as $user)
    @if($user->id !== Auth::id())<!--ログインユーザーの情報をリストから省く-->
    <div class="users-box">

    @if ($user->images && $user->images !== 'icon1.png')
    <img class="user-icon" src="{{ asset('storage/images/' . $user->images) }}" alt="{{ $user->username }}">
  @else
  <img class="user-icon" src="{{ asset('images/icon1.png') }}" alt="{{ $user->username }}">
@endif

    <p>{{$user->username}}</p>

    @if (in_array($user->id, $following))

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
  @endif

  @endforeach
</div>
@endsection
