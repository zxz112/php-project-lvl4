<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate();
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
            $users['empty'] = '';
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
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if (Auth::check()) {
            $statusesAll = \App\TaskStatus::get();
            $statuses = $statusesAll->pluck('name', 'id');
            $usersAll = \App\User::get();
            $users = $usersAll->pluck('name', 'id');
            $users['empty'] = '';
            return view('task.edit', compact('task', 'users', 'statuses'));
        }
        flash('failed delete')->error();
        return redirect()->route('tasks.index');
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
        if (Auth::check()) {
            $data = $this->validate($request, ['name' => 'required']);
            $task->fill($data);
            $task->save();
            flash('success edit')->success();
            return redirect()->route('tasks.index');
        }
        return redirect()->route('tasks.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if (Auth::check() && Auth::user()->id === $task->creator->id) {
            if ($task) {
                $task->delete();
            }
            flash('success delete')->success();
            return redirect()
                ->route('tasks.index');
        }
        flash('failed delete')->error();
        return redirect()->route('tasks.index');
    }
}
