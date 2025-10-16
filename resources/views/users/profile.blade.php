<x-login-layout>
<div class="UserProfile">
        <div class="UserProfile-container">
            <div class="text_container">
                @if($otherUser->icon_image == 'icon1.png')
                    <img class="icon-logo" src="{{ asset('images/icon1.png') }}">
                @else
                    <img class="icon-logo" src="{{ asset('storage/images/' . $otherUser->icon_image) }}" >
                @endif
            </div>
            <div class="UserProfile-text">
                <p>ユーザー名　　　{{ $otherUser->username }}</p>
                <p>自己紹介　　　　{{ $otherUser->bio }}</p>
            </div>
        </div>
        <!-- ↓ログイン中の人ユーザー　モデルUser.php のisFollowingメソッドの$otherUser-->
        <div class="UserProfile-btn">
            @if(auth()->user()->isFollowing($otherUser))
                <form action="{{ route('follows.unfollow', ['id' => $otherUser->id]) }}" method="POST">
            @csrf
                <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
            @elseif($otherUser->id == Auth::user()->id)
                <p></p>
                <!-- elseifで「自身のIDならば空にする」を条件分岐 -->
            @else
                <form action="{{ route('follows.toggle', ['id' => $otherUser->id]) }}" method="POST">
            @csrf
                <button type="submit" class="btn btn-primary">フォロー</button>
                </form>

            @endif
        </div>

</div>



<!-- 「1対多の関係」
        もしユーザーアイコン登録なければicon２-->
        <!-- ↓コントローラーから持ってくる -->

@foreach ($postId as $postID)
<div class="ListPost">
@if($postID->user->icon_image == 'icon1.png')
    <img class="PostIcon-logo" src="{{ asset('images/icon1.png') }}">
@else
    <img class="PostIcon-logo" src="{{ asset('storage/images/' . $postID->user->icon_image) }}" >
@endif
    <div class="post-container">
        <p>{{ $postID->user->username }}</p>
        <p>{{ $postID->post }}</p>
    </div>
    <div class="post-time">
        <p>{{ $postID->created_at }}</p>
    </div>
</div>
@endforeach


</x-login-layout>
