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
<div class=ListPost>
  <div class="post">
      <!-- 「1対多の関係」
      もしユーザーアイコン登録なければicon２-->
      @if(optional($post->user)->icon_image == 'icon1.png')
        <img class="PostIcon-logo" src="{{ asset ('images/'. optional($post->user)->icon_image) }}" alt="ユーザーアイコン">
      @else
        <img class="PostIcon-logo" src="{{ asset ('storage/images/' .  optional($post->user)->icon_image) }}" alt="ユーザーアイコン">
      @endif
          <div class="post-container">
            <p>{{ $post->user->username }}</p>
            <p>{{ $post->post }}</p>
          </div>
          <div class="post-time">
            <p>{{ $post->created_at }}</p>
          </div>
    </div>

  <!-- 画像の編集ボタン -->
  @if (Auth::id() == $post->user_id)
  <div class="btn-UpDate">
    <button class="js-modal-open edit-button" type="button" post="{{ $post->post }}" post_id="{{ $post->id }}" data-toggle="modal" data-target="#editModal">
    </button>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-footer">
                  <input type="text" class="text_modal" name="post" value="{{ $post->post }}"></input>
                  <input type="image" class="btn_modal" name="submit" src="images/edit.png"></input>
                </div>
            </form>
          </div>
      </div>
  </div>
</div>







</x-login-layout>
