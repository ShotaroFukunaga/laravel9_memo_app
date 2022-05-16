<?php

namespace App\Services;

use App\Models\task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskService
{


  
  public function getTasks($request)
  {
    $query = Task::query();
    
    if($search = $request->input('search')){
    $this->searchTask($search,$query);
    }
    elseif($request->input('due')){
    $this->dueTask($request,$query);
    }
    else{
      $this->statusTask($request,$query);
    }
    
    return $query->where('user_id', Auth::id())
                
                ->orderBy('created_at','DESC')
                ->paginate(5);

  }

  public function statusTask($request,$query)
  {
    $status = 0;
    if($request->input('cmp')){
      $status = 1;//簡潔にすること!!
    }
    return $query->where('status', $status);
  }

  public function dueTask($request,$query)
  {
    
      return $query->where('deadline','<',Carbon::now());
    
  }

  public function searchTask($search,$query)
  {
    //$searchの値がNULLでなければ
      $convert_space = mb_convert_kana($search, 's');//mb_convert_kana — カナを("全角かな"、"半角かな"等に)変換する
      $wordSearched = preg_split('/[\s,]+/',$convert_space, -1, PREG_SPLIT_NO_EMPTY);//preg_split — 正規表現で文字列を分割する
                                      // PREG_SPLIT_NO_EMPTY このフラグを設定すると、空文字列でないものだけが preg_split() により返される
      foreach($wordSearched as $value){
        $query->where('title','like','%'.$value.'%');
      }
    
  }


  public function checkOwnTask(int $userId, int $taskId): bool
  {
    $task = Task::where('id',$taskId)->first();
    if(!$task){
      return false;
    }

    return $task->user_id === $userId;
  }

}