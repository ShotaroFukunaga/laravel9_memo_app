@extends('adminlte::page')

@section('title','タスク編集')

@section('content')
  
  <x-task-validation-errors class="mb-4" :errors="$errors" />
  
  {{ Form::model($task,['method'=>'put', 'route'=>['task.update',$task->id]]) }}
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
                <div class="form-group">
                {{ Form::label('status','未対応')}}
                {{ Form::radio('status', '0') }}
                {{ Form::label('status','対応済み')}}
                {{ Form::radio('status', '1') }}
                <!-- {{ Form::radio('status', '未対応') }} -->
                  <!-- {!! Form::label('status', 'Status') !!}
                  {{ Form::select('status',['0' => '未対応', '1' => '完了', '2' => '期限超過', '3' => '福永'], 0, ['class' => 'form-control custom-select']) }} -->
                </div>
                <div class="form-group">
                {{Form::label('date','期限',['class' => 'col-md-2 col-form-label text-left'])}}
                {{ Form::date('deadline', null, ['class'=>'col-md-5 form-control']) }}
                </div>
            </div>
            <div class="card-footer">
            <!-- <form action="{{ route('task.destroy', $task->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('削除してもよろしいですか？');">削除</button>
              </form> -->
                <div class="row">
                    <a class="btn btn-default" href="{{ route('task.index') }}" role="button">戻る</a>
                    
                    <div class="ml-auto">
                    {!! Form::submit('更新', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <form action="{{ route('task.destroy', $task->id) }}" method="post">
                <!-- フォームリクエストに@csrfを埋め込むことでトークンを生成していくれる。<input type="hidden" name="token" value="aegadvbah2q3wtwj">みたいな -->
                @csrf
                @method('DELETE')
                <!-- HTMLのformタグがgetとpostしか対応していないため@method('PUT' or 'DELETE')が必要になる -->
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('削除してもよろしいですか？');">削除</button>
              </form>
                </div>
            </div>
    </div>
    </div>
  {{ Form::close() }}
 
@stop

