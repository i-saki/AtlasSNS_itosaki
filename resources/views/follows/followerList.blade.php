<x-login-layout>

<h2>フォロワーリスト</h2>
@foreach ($users as $user)
   <a href="{{ route('profile.show', ['id' => $user->id]) }}">
   @if($user->icon_image == 'icon1.png')
      <img class="icon-logo" src="{{ asset('images/icon1.png') }}">
   @else
      <img class="icon-logo" src="{{ asset('storage/images/' . $user->icon_image) }}" >
      @endif
   </a>
@endforeach


@foreach($posts as $post)
   <div class="container">
      <a href="{{ route('profile.show', ['id' => $post->user->id]) }}">
   @if($post->user->icon_image == 'icon1.png')
      <img class="icon-logo" src="{{ asset('images/icon1.png') }}">
   @else
      <img class="icon-logo" src="{{ asset('storage/images/' . $post->user->icon_image) }}" >
   @endif
   </a>
      <p>{{ $post->user->username }}</p>
      <p>{{ $post->post }}</p>
      <p>{{ $post->created_at }}</p>
   </div>
@endforeach

</x-login-layout>
