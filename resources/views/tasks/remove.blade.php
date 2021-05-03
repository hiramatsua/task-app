<!-- tasks edit.blade.php タスクの編集 -->
@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset-3 col-md-6">
                <nav class="panel panel-default">
                    <div class="panel-heading">タスクを削除する</div>
                    <div class="panel-body">
                    <!-- エラー表示 -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('tasks.remove', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <p>{{ $task->title }}</p>
                            </div>
                            <div class="form-group">
                                <label for="status">進捗</label>
                                <p>
                                    @foreach(\App\Models\Task::STATUS as $key => $val)
                                        @if ($key == $task->status)
                                            {{ $val['label'] }}
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="due_date">期限</label>
                                <p>{{ $task->formatted_due_date }}</p>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-danger">削除</button>
                                <p><a href="#" onClick="history.back(); return false;">前のページにもどる</a></p>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
