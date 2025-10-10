<x-login-layout>
<!-- 検索機能ここから -->
  <div class="search-header">
    <form action="{{ route('search') }}" method="GET">
      <input type="text" name="keyword" placeholder="ユーザー名">
      <input type="image" class="btn-glass" name="submit" src="{{ asset('images/search.png') }}" alt="検索">
    </form>
    @if (request('keyword'))
      <p>検索ワード: {{ request('keyword') }}</p>
    @endif
  </div>


  <!-- ('keyword')を表示させる ⇧name="keyword"一致させる-->

  <div class="user-list">
    @foreach ($users as $user)
    <div class="user-list-wrapper">
      <ul>
      <!-- ユーザーのアイコン -->
      @if($user->icon_image == 'icon1.png')
        <li><img class="search-icon" src="{{ asset ('images/'. $user->icon_image) }}" alt="ユーザーアイコン"></li>
      @else
        <li><img class="search-icon" src="{{ asset ('storage/images/' . $user->icon_image) }}" alt="ユーザーアイコン"></li>
      @endif
        <li><div class=username-list>{{ $user->username }}</div></li>
      </ul>

      <!--ボタンを表示 -->
      <div class="search-btn">
      @if(auth()->user()->isFollowing($user))
        <form action="{{ route('follows.unfollow', ['id' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger">フォロー解除</button>
        </form>
      @else
        <form action="{{ route('follows.toggle', ['id' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-primary">フォロー</button>
        </form>
      @endif
      </div>
    </div>
    @endforeach
  </div>
</x-login-layout>
