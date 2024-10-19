<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id="header">
            <div id="row-content">
                <div class="header-logo">
                    <h1><a href="/top"><img src="/images/atlas.png"></a></h1>
                </div>


                <div id="header-menu">
                    <div class="header-profile">
                        <p>{{$username}}　さん</p>
                    </div>


                    <div class="accordion-menu">
                        <button class="accordion-btn" onclick="toggleAccordion(this)"><span class="arrow-down"></span></button>
                        <div class="accordion-content">
                            <ul>
                                <li><a href="/top">HOME</a></li>
                                <li><a href="/profile">プロフィール編集</a></li>
                                <li><a href="/logout">ログアウト</a></li>
                            </ul>
                        </div>
                    </div>

                    @if ($images !== 'icon1.png')
                        <img class="user-icon" src="{{ url('storage/images/' . $images) }}">
                    @else
                        <img class="user-icon" src="{{ url('images/icon1.png') }}">
                    @endif

                </div>

            </div>
        </div>
    </header>

    <div id="main-content">

        <div id="post-wrapper">
            @yield('content')
        </div>

        <div class="side-bar-wrapper">

            <div id="side-bar">
                <div id="side-follows">
                    <p>{{$username}}さんの</p>

                    <div class="side-bar-followsCount">
                        <div>
                            <!--フォローリスト-->
                            <p>フォロー数 {{$followCount}}人</p>
                        </div>
                        <div class="follows-list-btn">
                            <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                        </div>
                    </div>

                    <div class="side-bar-followsCount">
                        <div>
                            <!--フォロワーリスト-->
                            <p>フォロワー数{{$followerCount}}人</p>
                        </div>
                        <div class="follows-list-btn">
                            <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
                        </div>
                    </div>

                </div>
                <div class="side-bar-search-btn">
                    <p class="btn"><a href="/search">ユーザー検索</a></p>
                </div>

            </div>

        </div>


    </div>
    <footer>
    </footer>
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
    <script src="{{ asset('js/edit-modal.js')}}"></script>
</body>
</html>
