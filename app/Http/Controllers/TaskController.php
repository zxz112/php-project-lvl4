<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::check()) {
            $task = new Task();
            $statusesAll = \App\TaskStatus::get();
            $statuses = $statusesAll->pluck('name', 'id');
            $usersAll = \App\User::get();
            $users = $usersAll->pluck('name', 'id');
            $users['null'] = '';
            return view('task.create', compact('task', 'statuses', 'users'));
        }

        return redirect()->route('task.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::check()) {
            $data = $this->validate($request, [
                'name' => 'required',
                'description' => '',
                'task_status_id' => '',
                'assigned_to_id' => ''

            ]);
            $data['created_by_id'] = \Auth::user()->id;
            $task = new \App\Task();
            $task->fill($data);
            $task->save();
            flash('task has been added')->success();
                return redirect()
                    ->route('tasks.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
