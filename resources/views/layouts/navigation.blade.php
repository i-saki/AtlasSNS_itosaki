
<div id="head">
  <div>
    <a href="{{ route('posts.index') }}"><img class="atlas-logo" src="/images/atlas.png"></a>
  </div>
  <div class="menu-container">
    <h1><?php $user = Auth::user(); ?>{{ $user->username }}さん</h1>
    <div class="accordion">
      <div class="accordion-item">
        <div class="accordion-header js-menu">
          <span class="arrow">▼</span>
        </div>
      <div class="accordion-content">
        <ul>
          <li><a href="/index">ホーム</a></li>
          <li><a href="/profiles/profile">プロフィール</a></li>
          <li><a href="{{ route('logout') }}">ログアウト</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
