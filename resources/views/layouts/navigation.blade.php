
<div id="head">
  <div>
    <a href="{{ route('posts.index') }}"><img class="atlas-logo" src="/images/atlas.png"></a>
  </div>


  <div class="menu-container">
    <div class="headUserName">
      <p>{{ Auth::user()->username }}　さん</p>
    </div>
    <div class="accordion-header js-menu">
      <span class="arrow">＞ </span>
    </div>
    <nav class="accordion-content">
      <ul>
        <a href="/index"><li>HOME</li></a>
        <a href="/profiles/profile"><li>プロフィール編集</li></a>
        <a href="{{ route('logout') }}"><li>ログアウト</li></a>
      </ul>
    </nav>
    <div class="header-icon">
      <a href="/profiles/profile">
    @if (Auth::user()->icon_image == 'icon1.png')
        <img class="headerIcon-logo" src="{{ asset('images/' . Auth::user()->icon_image) }}">
    @else
        <img class="headerIcon-logo" src="{{ asset('storage/images/' . Auth::user()->icon_image) }}">
    @endif
      </a>
    </div>
  </div>
</div>
