<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    @yield('styles')
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <nav class="my-navbar">
            <a class="my-navbar-brand" href="{{ route('home') }}">
                <i class="fa fa-btn fa-home"></i>ToDo App</a>
            <div class="my-navbar-control">
                @if(Auth::check())
                <!-- ログイン時 -->
                    <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
                    <form method="post" name="logout" action="{{ route('logout') }}">
                        @csrf
                        <a href="javascript:logout.submit()">
                            <i class="fa fa-btn fa-sign-out"></i>ログアウト</a>
                    </form>
                @else
                <!-- ログインしていない時 -->
                    <a href="{{ route('login') }}" class="my-navbar-item">
                        <i class="fa fa-btn fa-sign-in"></i>ログイン</a>｜
                    <a href="{{ route('register') }}" class="my-navbar-item">
                        <i class="fa fa-btn fa-user"></i>ユーザ登録</a>
                @endif
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
