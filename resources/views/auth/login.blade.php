@extends('layouts.logout')

@section('content')

<div class="login-form">

  @if ($errors->any())
    <div class="error">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
    </ul>
    </div>
  @endif
  {!! Form::open(['url' => '/login']) !!}

  <div class="login-form-text">
    <p>AtlasSNSへようこそ</p>
  </div>

  <div class="login-form-input">
    <div class="input-mail-form">
      {{ Form::label('メールアドレス') }}
      {{ Form::text('mail', null, ['class' => 'input']) }}
    </div>

    <div class="input-password-form">
      {{ Form::label('パスワード') }}
      {{ Form::password('password', ['class' => 'input']) }}
    </div>


  </div>

  <div class="login-form-button">
    {{ Form::submit('ログイン') }}
  </div>

  <div class="login-form-link">
    <p><a href="/register">新規ユーザーの方はこちら</a></p>
  </div>

  {!! Form::close() !!}

  @endsection
</div>
