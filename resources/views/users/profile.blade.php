@extends('layouts.login')

@section('content')
<div class='profile-edit-content'>


  <div class="edit-form-icon">
    @if ($images !== 'icon1.png')
    <img class="user-icon" src="{{ url('storage/images/' . $images) }}">
  @else
  <img class="user-icon" src="{{ url('images/icon1.png') }}">
@endif
  </div>

  <form action="{{route('profile.edit')}}" method="post" enctype="multipart/form-data">

    @csrf

    @if ($errors->any())
    <div class="error">
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
      </ul>
    </div>
  @endif




    <div class="edit-form-area">
      <div class="form-group">

        <h1>ユーザー名</h1>
        <input type="text" name="username" value="{{$username}}" required>
      </div>

      <div class="form-group">
        <h1>メールアドレス</h1>
        <input type="email" name="mail" value="{{$mail}}" required>
      </div>

      <div class="form-group">
        <h1>パスワード</h1>
        <input type="password" name="new_password" required>
      </div>

      <div class="form-group">
        <h1>パスワード確認</h1>
        <input type="password" name="new_password_confirmation" required>
      </div>

      <div class="form-group">
        <h1>自己紹介</h1>
        <input type="text" name="bio" value="{{$bio}}">
      </div>

      <div class="form-group">
        <h1>アイコン画像</h1>
        <div class="file-input-container">
          <input type="file" name="images">
        </div>
      </div>
    </div>
    <button type="submit" class="edit-update-button">
      <span>更新</span>
    </button>
  </form>
</div>





@endsection
