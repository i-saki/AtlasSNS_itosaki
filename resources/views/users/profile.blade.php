<x-login-layout>
<div class="container">
@if($otherUser->icon_image == 'icon1.png')
    <img class="icon-logo" src="{{ asset('images/icon1.png') }}">
@else
    <img class="icon-logo" src="{{ asset('storage/images/' . $otherUser->icon_image) }}" >
@endif
    <p>ユーザー名{{ $otherUser->username }}</p>
    <p>自己紹介{{ $otherUser->bio }}</p>
</div>

<!--ボタンを表示 -->
<!-- ↓ログイン中の人ユーザー　モデルUser.php のisFollowingメソッドの$otherUser-->
@if(auth()->user()->isFollowing($otherUser))
    <form action="{{ route('follows.unfollow', ['id' => $otherUser->id]) }}" method="POST">
@csrf
    <button type="submit" class="btn btn-danger">フォロー解除</button>
    </form>
@else
    <form action="{{ route('follows.toggle', ['id' => $otherUser->id]) }}" method="POST">
@csrf
    <button type="submit" class="btn btn-primary">フォロー</button>
    </form>
@endif


<!-- 「1対多の関係」
        もしユーザーアイコン登録なければicon２-->
        <!-- ↓コントローラーから持ってくる -->
@foreach ($postId as $postID)
@if($postID->user->icon_image == 'icon1.png')
    <img class="icon-logo" src="{{ asset('images/icon1.png') }}">
@else
    <img class="icon-logo" src="{{ asset('storage/images/' . $postID->user->icon_image) }}" >
@endif
    <div class="container">
        <p>{{ $postID->user->username }}</p>
        <p>{{ $postID->created_at }}</p>
        <p>{{ $postID->post }}</p>
    </div>
@endforeach


</x-login-layout>
