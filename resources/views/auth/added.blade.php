<x-logout-layout>

<div class="gradientBody">
    <div class="gray-container-welcome">
      <div class="welcome-text1">
        <p>{{ $user->username }}さん</p>
        <p>ようこそ!AtlasSNSへ</p>
      </div>
      <div class="welcome-text2">
        <p>ユーザー登録が完了いたしました。</p>
        <p>早速ログインをしてみましょう!</p>
      </div>

      <a href="{{ route('logout') }}" class="welcome-login-btn">ログイン画面へ</a>

    </div>
</div>
</x-logout-layout>
