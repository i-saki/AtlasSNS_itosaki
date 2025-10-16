<x-logout-layout>

<div class="gradientBody">
  <div class="gray-container-login">
    <!-- 適切なURLを入力してください -->
    {!! Form::open(['url' => 'login']) !!}

    <div class="welcome">AtlasSNSへようこそ</div>

        <p>{{ Form::label('メールアドレス') }}</p>
        <div class="form-text">{{ Form::text('email',null,['class' => 'input']) }}</div>

        <p>{{ Form::label('パスワード') }}</p>
        <div class="form-text">{{ Form::password('password',['class' => 'input']) }}</div>

    <div class="login-btn">{{ Form::submit('ログイン') }}</div>

    {!! Form::close() !!}
    <a href="register" class="next-register">新規ユーザーの方はこちら</a>
  </div>
</div>
</x-logout-layout>
