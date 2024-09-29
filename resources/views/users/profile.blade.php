@extends('layouts.login')

@section('content')
<div class='profile-edit-content'>
  <div class="profile-edit-form">
    <form action="{{route('profile.edit')}}" method="post" enctype="multipart/form-data">

      @csrf

      @if ($errors->any())
      <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
      </ul>
      </div>
    @endif

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
        <input type="file" name="images">
      </div>

      <button type="submit">
        <h1>更新</h1>
      </button>
    </form>
  </div>

</div>



@endsection
