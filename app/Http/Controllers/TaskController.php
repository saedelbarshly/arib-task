<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Filters\TaskFilter;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index');
    }
    public function data(TaskFilter $filter)
    {
        $tasks = Task::filter($filter)->paginate(2);
        $data = view('task.data_tabel', compact('tasks'))->render();
        $links = $tasks->links()->render();
        return response()->json([
            'data' => $data,
            'links' => $links
        ]);
    }

    public function create()
    {
        $employees = User::where('manager_id',auth()->user()->id)->get();
        return view('task.create',compact('employees'));
    }

    public function store(TaskRequest $request)
    {
        try {
            $data = $request->except('_token');
            Task::create($data);
            return redirect()->route('task.index')->with('success','Task created successfully');
        } catch (\Throwable $th) {
            return redirect()->route('task.index')->with('faild','Tray again later');
        }
    }

    public function edit(Task $task)
    {
        $employees = User::where('manager_id',auth()->user()->id)->get();
        return view('task.edit',compact('task','employees'));
    }
    public function update(TaskRequest $request,Task $task)
    {
        try {
            $data = $request->except('_token');
            $task->update($data);
            return redirect()->route('task.index')->with('success','Task Updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('task.index')->with('faild','Tray again later');
        }
        
    }
}
