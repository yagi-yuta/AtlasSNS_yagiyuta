@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->




{!! Form::open(['url' => '/register']) !!}

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

  <div class="login-form-text">
    <h2>新規ユーザー登録</h2>
  </div>

  <div class="login-form-input">
    <div class="input-form">
      {{ Form::label('ユーザー名') }}
      {{ Form::text('username', null, ['class' => 'input']) }}
    </div>

    <div class="input-form">
      {{ Form::label('メールアドレス') }}
      {{ Form::text('mail', null, ['class' => 'input']) }}
    </div>

    <div class="input-form">
      {{ Form::label('パスワード') }}
      {{ Form::password('password', null, ['class' => 'input']) }}
    </div>

    <div class="input-form">
      {{ Form::label('パスワード確認') }}
      {{ Form::password('password_confirmation', null, ['class' => 'input']) }}
    </div>

    <div class="login-form-user-button">
      {{ Form::submit('新規登録') }}
    </div>



  </div>


  <div class="login-form-link">
    <p><a href="/login">ログイン画面へ戻る</a></p>
  </div>


  {!! Form::close() !!}

  @endsection

</div>
