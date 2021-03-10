<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $task;

    function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return $this->task->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = $this->task->create($request->all());
        return response()->json($task, 200);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function pending(Task $task)
    {
        $task->pending_count += 1;

        if($task->pending_count > 2){
            $task->pending = false;
            return response()->json($task, 205);
        }else{
            $task->pending = true;
            $task->save();
            return response()->json($task, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function done(Task $task)
    {
        try{
            $task->pending = false;
            $task->save();
            return response()->json($task, 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
        }
        
    }
}
