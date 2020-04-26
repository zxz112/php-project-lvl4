<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskStatus;
use Auth;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::paginate();
        return view('task_status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $taskStatus = new TaskStatus();
            return view('task_status.create', compact('taskStatus'));
        }
        flash('need auth')->error();
        return redirect()
            ->route('task_statuses.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses',
            ]);
            $taskStatus = new TaskStatus();
            $taskStatus->fill($data);
            $taskStatus->save();
            flash('status has been added')->success();
            return redirect()
                ->route('task_statuses.index');
        }
        return redirect()
            ->route('task_statuses.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $taskStatus = TaskStatus::find($id);
            return view('task_status.edit', compact('taskStatus'));
        }
        flash('failed edit')->error();
        return redirect()->route('task_statuses.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $taskStatus = TaskStatus::find($id);
            $data = $this->validate($request, ['name' => 'required|unique:task_statuses']);
            $taskStatus->fill($data);
            $taskStatus->save();
            flash('success edit')->success();
            return redirect()->route('task_statuses.index');
        }
        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $status = TaskStatus::find($id);
            if ($status) {
                $status->delete();
                flash('success delete')->success();
                return redirect()
                    ->route('task_statuses.index');
            }
        }
        flash('failed delete')->error();
        return redirect()->route('task_statuses.index');
    }
}
