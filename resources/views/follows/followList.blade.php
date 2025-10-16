<x-login-layout>

<div class="FollowList-header">
    <h2>フォローリスト</h2>
      <div class=LineIcons>
      @foreach ($users as $user)
        <a href="{{ route('profile.show', ['id' => $user->id]) }}">
          <!-- クリックしたときにそのユーザーのプロフィールページに飛ぶリンクを作っています。 -->
      @if($user->icon_image == 'icon1.png')
          <img class="FollowList-icon" src="{{ asset('images/icon1.png') }}">
      @else
          <img class="FollowList-icon" src="{{ asset('storage/images/' . $user->icon_image) }}" >
      @endif
        </a>
      @endforeach
      </div>
</div>
  <!-- Laravelで画像アイコンをクリックして別のページに遷移させるには、HTMLの<img>タグに<a>タグをラップし、<a>タグのhref属性に遷移先のURLを指定します。
-->


  @foreach($posts as $post)
<div class="ListPost">
    <div class="post">
      <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">
        @if($post->user->icon_image == 'icon1.png')
          <img class="PostIcon-logo" src="{{ asset('images/icon1.png') }}">
        @else
          <img class="PostIcon-logo" src="{{ asset('storage/images/' . $post->user->icon_image) }}" >
        @endif
      </a>
      <div class="post-container">
          <p>{{ $post->user->username }}</p>
          <p>{{ $post->post }}</p>
      </div>
      <div class="post-time">
          <p>{{ $post->created_at }}</p>
      </div>
    </div>
</div>
  @endforeach


</x-login-layout>
