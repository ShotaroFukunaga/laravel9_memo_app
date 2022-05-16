@extends('adminlte::page')

@section('title','タスク一覧')

@section('content_header')
  <h1>タスク一覧</h1>
@stop

@section('content')

<x-task-validation-errors class="mb-4" :errors="$errors" />

@if(session('message'))
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
      x
    </button>
    {{session('message')}}
  </div>
@endif



<form class="block mb-2 mt-4" method="GET" action="{{ route('task.index') }}">
@csrf
    <input class="form-control mt-1" type="text" placeholder="検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
        <label for="status" class="inline-flex items-center">
            <input id="status" type="checkbox" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="cmp">
            <span class="ml-2 text-sm text-gray-600">{{ __('完了済み') }}</span>
        </label>

        <label for="due" class="inline-flex items-center">
            <input id="due" type="checkbox" value="due" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="due">
            <span class="ml-2 text-sm text-gray-600">{{ __('期限超過') }}</span>
        </label>

        <label for="submit" class="inline-flex items-right">
        <button class="btn btn-info my-2" value="start" type="submit">検索</button>
        <a class="btn btn-secondary my-2 ml-5" href="{{ route('task.index') }}" role="button">クリア</a>
        </label>
    
    <a class="btn btn-primary mb-2" href="{{ route('task.create') }}" role="button">タスク追加</a>

</form>


<div class="card">
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ユーザーID</th>
          <th>タスク</th>
          <!-- <th>コンテンツ</th>
          <th>状態</th> -->
          <th colspan="3">期日</th>
        </tr>
      </thead>
      <tbody>
      <!-- 後でユーザーのタスク情報をコントローラーで制限 -->
        @foreach($tasks as $task)
          <tr>
            <td>
              {{ $task->user_id}}</br>
              {{ $task->user->name }}
            </td>
            <td>{{ $task->title }}</td>
            <!-- <td>{{ $task->content }}</td>
            <td>{{ $task->status }}</td> -->
            <td>{{ $task->deadline?->format('Y/m/d') ?? ''}}</td>
            <!-- NULL文字はフォーマット出来ないのでNULLセーフを使用,PHP8.0以前は deadline === null ? '' : deadline->format('Ydm') -->
            
            <!-- <td>
              <a class="btn btn-primary btn-sm mb-2" href="{{ route('task.edit', $task->id) }}"
                  role="button">編集</a>
              <form action="{{ route('task.destroy', $task->id) }}" method="post"> -->
                <!-- フォームリクエストに@csrfを埋め込むことでトークンを生成していくれる。<input type="hidden" name="token" value="aegadvbah2q3wtwj">みたいな -->
                <!-- @csrf
                @method('DELETE') -->
                <!-- HTMLのformタグがgetとpostしか対応していないため@method('PUT' or 'DELETE')が必要になる -->
                <!-- <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('削除してもよろしいですか？');">削除</button>
              </form>
            </td> -->
           
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  
    
    <div class="d-flex justify-content-center">
      {{ $tasks->appends(request()->input())->links() }}
    </div>

</div>
@stop