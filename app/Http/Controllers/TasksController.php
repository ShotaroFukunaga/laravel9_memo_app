<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => ['edit','update','destroy']]);
    }
    

    public function index(Request $request,TaskService $taskService)//requestで渡された値を取得するにはinput関数を使用
    {
        // $query = Task::query();
        // $tasks = $taskService->getTasks();
      $tasks = $taskService->getTasks($request);
        // $tasks = $taskService->searchTask($request,$tasks);

        return view('task.index')
            ->with([//この書き方だと返す変数を連続してかけるので便利
                'tasks' => $tasks,
                // 'search' => $search,
            ]);
    }


    public function create()
    {
        //
        return view('task.create');
    }


    public function store(TaskRequest $request)//App/Http/Request/TaskRequest を通ってバリテージョンチェックを受けた値が$requestに代入されている
    {
        //
        $task = new Task;
        $task->user_id = $request->userId();
        $task->fill($request->all())->save();
        // fill()を使うときには一度Modelを見に行って$fillableで指定されている項目かどうかをチェックして、$fillableで指定されているものだけがsave()される
        return redirect()->route('task.index')->with('message','登録しました');
    }



    public function edit($taskId,TaskService $taskService)
    {
        $user_id = Auth::id();
        if(!$taskService->checkOwnTask($user_id, $taskId)){
            return redirect()->route('task.index')->with('errors','貴様は誰だ！！');
        }

        $task = Task::find($taskId);
        return view('task.edit',[
            'task' => $task
        ]);
    }

 
    public function update(Request $request,$taskId,TaskService $taskService)
    {
        if(!$taskService->checkOwnTask($request->user()->id, $taskId)){
            throw new AccessDeniedHttpException();
        }
        $task = Task::where('id', $taskId)->firstOrFail();
        $task->fill($request->all())->save();

        return redirect()->route('task.index')->with('message','編集しました');
    }

  
    public function destroy($id,TaskService $taskService)
    {
        $user_id = Auth::id();
        if(!$taskService->checkOwnTask($user_id, $id)){
            throw new AccessDeniedHttpException();
        }
        task::where('id',$id)->delete();

        return redirect()->route('task.index')->with('message','削除しました');
    }
}
