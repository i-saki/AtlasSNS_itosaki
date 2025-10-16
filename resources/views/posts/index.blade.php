<x-login-layout>

    <form action="{{ route('posts.create') }}" method="POST">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    <!-- セキュリティ 忘れがち419エラー-->
      <div class=text_box>
        <div class="text_container">
          @if (Auth::user()->icon_image == 'icon1.png')
              <img class="icon-logo" src="{{ asset('images/' . Auth::user()->icon_image) }}">
          @else
              <img class="icon-logo" src="{{ asset('storage/images/' . Auth::user()->icon_image) }}">
          @endif
          <input required class="text_post" placeholder="投稿内容を入力してください。" name="description" type=text ></input>
          <input type="image" class=btn_post name="button" src="images/post.png"></input>
        </div>
      </div>
    </form>

@foreach ($postID as $post)
<div class="ListPost">
    <div class="post">
      <!-- 「1対多の関係」
      もしユーザーアイコン登録なければicon２-->
      <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">
      @if(optional($post->user)->icon_image == 'icon1.png')
        <img class="PostIcon-logo" src="{{ asset ('images/'. optional($post->user)->icon_image) }}" alt="ユーザーアイコン">
      @else
        <img class="PostIcon-logo" src="{{ asset ('storage/images/' .  optional($post->user)->icon_image) }}" alt="ユーザーアイコン">
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

  <!-- 編集ボタン -->
  @if (Auth::id() == $post->user_id)
  <div class="btnsUpDate">
    <a href="#" class="modal_open" post="{{$post->post}}" post_id="{{$post->id}}"><img class="edit-button" src="{{ asset('images/edit.png') }}"
        onmouseover="this.src='{{ asset('images/edit_h.png') }}'"
        onmouseout="this.src='{{ asset('images/edit.png') }}'"></a>
        <!-- onmouseover：ホバー時に画像を変更 -->
        <!-- onmouseout：ホバーを外した時に元に戻す-->
      <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button"></button>
      </form>
  </div>
  @endif
</div>
@endforeach


<!-- モーダル -->
<div class="modal_main">
  <div class="modal_inner">
    <div class="modal_container">
      <form action="{{url('postUpdate')}}" method="post">
        @csrf
        <textarea class="modal_text" name="upPost"></textarea>
        <input type="hidden" class="modal_id" name="id">
        <button type="submit"><img class="btn_modal" src="{{ asset('images/edit.png') }}"></button>
      </form>
    </div>
  </div>
</div>







</x-login-layout>
