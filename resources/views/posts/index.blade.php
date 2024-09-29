@extends('layouts.login')

@section('content')



<div id="post-form-wrapper">
    @if (request()->is('top'))



        <div id="post-form">

            <div class="post-form-icon">
                <img class="user-icon" src="{{asset('storage/images/' . ($images ?: 'icon1.png'))}}">
            </div>

            <form action="/post" method="post"> @csrf
                <textarea name="post" placeholder="投稿内容を入力してください。" required></textarea>

                <div class="button-wrapper">
                    <button type="submit"><img class="button" src="/images/post.png" alt="投稿"></button>
                </div>

            </form>

        </div>
    @endif
</div>


<div class="posts-wrapper">
    @foreach ($posts as $post)
        <div class="post-box">
            <img class="user-icon" src="{{ asset('storage/images/' . ($post->user->images ?: 'icon1.png')) }}">

            <div class="posts-post-area">
                <div class="posts-name-area">
                    <p>{{ $post->user->username }}</p>
                </div>
                {{ $post->post }}
            </div>
            <div>
                <div class="time-stamp">
                    <p>{{$post->created_at->format('y-m-d h:i')}}</p>
                </div>
                @if ($post->user_id === Auth::id())
                    <div class="button-area">
                        <div class="edit-button">
                            <button class="modal-open" data-id="{{$post->id}}" data-post="{{$post->post}}"><img class="button" src="/images/edit.png" alt="編集"></button>
                        </div>

                        <div class="delete-button">
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><img class="button" src="/images/trash.png" alt="削除"></button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>


        </div>

        <!-- モーダル -->
        <div id="modal-{{$post->id}}" class="modal">
            <div class="modal-form">
                <span class="modal-close-button">閉じる</span>
                <form id="modal-edit{{$post->id}}" method="POST" action="{{route('posts.update', $post->id)}}">
                    @csrf
                    @method('POST')
                    <input type="text" name="post" value="{{ $post->post }}">
                    <div class='modal-update-button'>
                        <button type="submit">更新</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>




@endsection
