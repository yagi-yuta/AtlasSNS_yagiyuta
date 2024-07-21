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
        <div id="head">
            <h1><a href="/top"><img src="/images/atlas.png"></a></h1>
            <div id="">
                <div id="">
                    <p>〇〇さん<img src="images/icon1.png"></p>
                    <div class="accordion-menu">
                        <button class="accordion-btn" onclick="toggleAccordion(this)">メニュー</button>
                        <div class="accordion-content">
                            <ul>
                                <li><a href="/top">ホーム</a></li>
                                <li><a href="/profile">プロフィール</a></li>
                                <li><a href="/logout">ログアウト</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
    </header>
    <div id="row">

    <!--投稿フォーム-->
        <div id="container">
            @yield('content')
            <form action="/top/post" method="post"> @csrf
            <input type="text" name="post"placeholder="投稿内容を入力してください。" required>
            <button type="submit" class="">投稿</button>
            </form>
            </div>
        </div>

        <div id="side-bar">
            <div id="confirm">
                <p>〇〇さんの</p>
                <div>
                    <!--フォローリスト-->
                    <p>フォロー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div>
                <!--フォロワーリスト-->
                    <p>フォロワー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
