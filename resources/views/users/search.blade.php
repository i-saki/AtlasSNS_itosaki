<x-login-layout>
<!-- 検索機能ここから -->
<div>
  <form action="{{ route('search') }}" method="GET">
    <input type="text" name="keyword" placeholder="ユーザー名">
    <input type="image" name="submit" src="images/search.png" alt="検索">
  </form>
</div>
<!-- ('keyword')を表示させる ⇧name="keyword"一致させる-->
@if (request('keyword'))
    <p>検索ワード: {{ request('keyword') }}</p>
@endif
<div class="user-list">
    @foreach ($users as $user)
    <div class="user-item">
  </div>
  <!-- ユーザーのアイコン -->
  <img src="{{ $user->getIconUrlAttribute()?? asset('images/icon1.png') }}" alt="{{ $user->username }}" class="user-icon">
  <!--ボタンを表示 -->
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

    @endforeach

</div>
</x-login-layout>
