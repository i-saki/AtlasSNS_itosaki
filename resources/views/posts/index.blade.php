<x-login-layout>

    <form action="{{ route('posts.create') }}" method="POST">
    @csrf
    <!-- セキュリティ 忘れがち419エラー-->
        <div>
          @if (Auth::user()->icon_image == 'icon1.png')
              <img class="icon-logo" src="{{ asset('images/' . Auth::user()->icon_image) }}">
          @else
              <img class="icon-logo" src="{{ asset('storage/images/' . Auth::user()->icon_image) }}">
          @endif
          <textarea name="description"  id="description" required></textarea>
          <input type="image" name="button" src="images/post.png">
        </div>
    </form>

    @foreach ($posts as $post)
    <!-- 「1対多の関係」
    もしユーザーアイコン登録なければicon２-->
    @if(optional($post->user)->icon_image == 'icon1.png')
      <img class="icon-logo" src="{{ asset ('images/'. optional($post->user)->icon_image) }}" alt="ユーザーアイコン">
    @else
      <img class="icon-logo" src="{{ asset ('storage/images/' .  optional($post->user)->icon_image) }}" alt="ユーザーアイコン">
    @endif
      <div class="container">
        <p>{{ $post->user->username }}</p>
        <p>{{ $post->created_at }}</p>
        <p>{{ $post->post }}</p>
      </div>
    <div class="content">
    <!-- 画像の編集ボタン -->
      <button class="js-modal-open edit-button" type="image" post="{{ $post->post }}" post_id="{{ $post->id }}" data-toggle="modal" data-target="#editModal">
      </button>
    </div>
    <!-- モーダル -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="post" value="{{ $post->post }}">
                  </div>
                  <div class="modal-footer">
                      <input type="image" name="submit" src="images/edit.png">
                    </form>
                  </div>
              </div>
          </div>
      </div>
    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('本当に削除しますか？');">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-button"></button>
    </form>
@endforeach





</x-login-layout>
