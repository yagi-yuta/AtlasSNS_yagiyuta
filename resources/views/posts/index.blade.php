@extends('layouts.login')

@section('content')



<div id="post-form-wrapper">
    @if (request()->is('top'))


        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div id="post-form">

            <div class="post-form-icon">
                @if ($images !== 'icon1.png')
                    <img class="user-icon" src="storage/images/{{$images}}">
                @else
                    <img class="user-icon" src="{{'images/icon1.png'}}">
                @endif

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


            @if (Auth::user()->id === $post->user_id)
                <!-- ログインユーザーの場合 -->
                @if ($images !== 'icon1.png')
                    <img class="user-icon" src="storage/images/{{$images}}">
                @else
                    <img class="user-icon" src="images/icon1.png">
                @endif
            @else
                <!-- 他のユーザーの場合 -->
                @if ($post->user->images !== 'icon1.png')
                    <img class="user-icon" src="storage/images/{{$post->user->images}}">
                @else
                    <img class="user-icon" src="images/icon1.png">
                @endif
            @endif

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
                            <button class="delete-modal-open" data-id="{{$post->id}}">
                                <img class="button" src="/images/trash.png" alt="削除">
                            </button>

                        </div>
                    </div>
                @endif
            </div>


        </div>

        <!-- モーダル -->
        <div id="modal-{{$post->id}}" class="modal">
            <div class="modal-form">
                <form id="modal-edit{{$post->id}}" method="POST" action="{{route('posts.update', $post->id)}}">
                    @csrf
                    @method('POST')
                    <input type="text" name="post" value="{{ $post->post }}">
                    <div class='modal-update-button'>
                        <button type="submit"><img class="button" src="/images/edit.png" alt="編集"></button>
                    </div>
                </form>
            </div>
        </div>

        <div id="delete-modal-{{$post->id}}" class="modal delete-modal">
            <div class="modal-form">
                <p>この投稿を削除します。よろしいでしょうか？</p>
                <div class="modal-buttons">
                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-confirm">OK</button>
                        <button type="button" class="modal-close-button">キャンセル</button>
                    </form>

                </div>
            </div>

        </div>

    @endforeach
</div>




@endsection
