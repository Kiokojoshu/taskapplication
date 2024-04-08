<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskControler extends Controller
{
    public function createTask(Request $request)
    {
        $userStatus = Auth::user()->status;

        if ($userStatus == 1) {
            $validatedData = $request->validate([
                'taskname' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'urgency' => 'required|string|max:255',
                'comments' => 'required|string|max:255',
                'assigned_to' => 'required|string|max:255',
                'due_date' => 'required|date',
            ]);

            $validatedData['assignee'] = Auth::id();

            $task = Task::create($validatedData);

            return redirect()->back()->with('success', 'Task created successfully');
        } else {
            return redirect()->back()->with('error', 'Your account is inactive, you are unable to create a task');
        }
    }

 public function edittasks(Request $request)
{
    $id = $request->input('code'); 

    $task = Task::find($id);

    if (!$task) {
        return redirect()->back()->with('error', 'Task not found');
    }

    $validatedData = $request->validate([
        'taskname' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'urgency' => 'required|string|max:255',
        'comments' => 'required|string|max:255',
        'assigned_to' => 'required|string|max:255',
        'due_date' => 'required|date',
    ]);

    //$task->update($validatedData);

    return view('home')->with('message', 'Task updated successfully');
}

public function assigntasks(Request $request)
{
    $id = $request->id; 

    $task = Task::find($id);

    if (!$task) {
        return redirect()->back()->with('error', 'Task not found');
    }

    $assigned_to = $request->input('assigned_to');

    $task->assigned_to = $assigned_to;
    $task->save();

    return redirect()->back()->with('message', 'Task assigned successfully');
}

}
