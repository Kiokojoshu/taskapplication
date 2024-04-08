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





}
