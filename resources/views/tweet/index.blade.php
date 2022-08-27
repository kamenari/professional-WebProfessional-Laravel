<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>つぶやきアプリ</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
    <h1>つぶやきアプリ</h1>
    @auth
    <div>
        <p>投稿フォーム</p>
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <form action="{{ route('tweet.create') }}" method="post">
            @csrf
            <label for="tweet-content">つぶやき</label>
            <span>140文字まで</span>
            <textarea id="tweet-content" type="text" name="tweet" placeholder="つぶやきを入力"></textarea>
            @error('tweet')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <button type="submit">投稿</button>
        </form>
    </div>
    @endauth
    <div>
        @foreach($tweets as $tweet)
        <details>
            <summary>
                <span>つぶやき内容:{{ $tweet->content }}</span>
                <br>
                <span>ユーザー名{{ $tweet->user->name }}</span>
            </summary>
            <div>
                <p>作成日時:{{ $tweet->created_at }}</p>
                <p>更新日時:{{ $tweet->updated_at }}</p>
                @if(\Illuminate\Support\Facades\Auth::id() === $tweet->user_id) 
                {{-- ログインしているユーザーのidとtweetのuser_idが一致しているか確認 --}}
                    <a href="{{ route('tweet.update.index', ['tweetId' => $tweet->id]) }}">編集</a>
                    <form action="{{ route('tweet.delete', ['tweetId' => $tweet->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">削除</button>
                    </form>
                @else
                    編集、削除はできません
                @endif
            </div>
        </details>
        @endforeach
    </div>
</body>
</html>