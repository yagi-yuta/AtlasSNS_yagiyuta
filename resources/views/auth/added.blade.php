@extends('layouts.logout')

@section('content')

<div class="login-form">
  <div class="added-bold-text">
    <p>{{$username}}さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
  </div>
  <div class="added-text">
    <p>ユーザー登録が完了いたしました。</p>
    <p>早速ログインをしてみましょう！</p>
  </div>

  <p class="added-button"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
