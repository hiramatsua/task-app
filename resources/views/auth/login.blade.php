@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">ログイン</div>
                    <div class="panel-body">
                        <!-- エラー表示 -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">ユーザＩＤ</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-sign-in"></i> ログイン</button>
                            </div>
                        </form>
                    </div>
                </nav>
                <div class="text-center">
                    <a href="{{ route('password.request') }}">パスワードの変更はこちらから</a>
                </div>
            </div>
        </div>
    </div>
@endsection
