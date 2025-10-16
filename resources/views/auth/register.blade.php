<x-logout-layout>

@if($errors->any())
    <div class="register_error">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
    <!-- 適切なURLを入力してください -->
<div class="gradientBody">
    <div class="gray-container-register">
        {!! Form::open(['url' => 'register']) !!}

        <div class="register-text">新規ユーザー登録</div>
            <p>{{ Form::label('ユーザー名') }}</p>
            <div class="form-text">{{ Form::text('username',null,['class' => 'input']) }}</div>

            <p>{{ Form::label('メールアドレス') }}<p>
            <div class="form-text">{{ Form::email('email',null,['class' => 'input']) }}</div>

            <p>{{ Form::label('パスワード') }}<p>
            <div class="form-text">{{ Form::password('password',null,['class' => 'input']) }}</div>

            <p>{{ Form::label('パスワード確認') }}<p>
            <div class="form-text">{{ Form::password('password_confirmation',null,['class' => 'input']) }}</div>

        <div class="register-btn">{{ Form::submit('新規登録') }}</div>

          {!! Form::close() !!}

        <a href="login" class="next-login">ログイン画面へ戻る</a>
    </div>
</div>

</x-logout-layout>
