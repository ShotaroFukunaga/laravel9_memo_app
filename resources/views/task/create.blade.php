@extends('adminlte::page')

@section('title','商品登録')

@section('content_header')
  <h1>商品登録</h1>
@stop

@section('content')

  <x-task-validation-errors class="mb-4" :errors="$errors" />
  
<!-- {{--登録画面--}}Form::openではPOST,PUT,DELETEメソッドは自動でCSRFトークンが追加されている -->
{{Form::open(['method'=>'post', 'route' => ['task.store']])}}
<div class="card">
            <div class="card-body">
                <div class="form-group">
                  {{ Form::label('title','タイトル')}}
                  {{ Form::text('title',null,['class'=>'form-control','placeholder'=>'タスクタイトル']) }}
                </div>
                <div class="form-group">
                  {{ Form::label('content','コンテンツ')}}
                  {{ Form::textarea('content',null,['class'=>'form-control','placeholder'=>'内容']) }}
                </div>
                <!-- <div class="form-group">
                  {!! Form::label('status', 'Status') !!}
                  {{ Form::select('status',['0' => '未対応', '1' => '完了', '2' => '期限超過', '3' => '福永'], 0, ['class' => 'form-control custom-select']) }}
                </div> -->
                <div class="form-group">
                {{Form::label('date','期限',['class' => 'col-md-2 col-form-label text-left'])}}
                {{ Form::date('deadline', null, ['class'=>'col-md-5 form-control']) }}
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <a class="btn btn-default" href="{{ route('task.index') }}" role="button">戻る</a>
                    <div class="ml-auto">
                    {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                </div>
            </div>
    </div>
    {!! Form::close() !!}
@stop
