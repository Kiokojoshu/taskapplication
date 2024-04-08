<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $ida=Auth::user()->id;
        $kioko=DB::select('select assignee.id AS assignee_id,assignee.name AS assignee_name,assignee.status AS assignee_status,assigned_to.id AS assigned_to_id,assigned_to.name AS assigned_to_name,assigned_to.status AS assigned_to_status,tasks.id as ida,tasks.taskname,tasks.description,tasks.urgency,tasks.comments,tasks.due_date,tasks.status FROM tasks JOIN users AS assignee ON assignee.id = tasks.assignee JOIN users AS assigned_to ON assigned_to.id = tasks.assigned_to WHERE  assignee= ? or assigned_to= ?', [$ida,$ida]);

       

        $taskbars=DB::select('select*from tasks where status=0 AND (assignee= ? or assigned_to= ?)', [$ida,$ida]);
        $usersa=count($taskbars);

        $complited=DB::select('select*from tasks where status=3 AND (assignee= ? or assigned_to= ?)', [$ida,$ida]);
        $complited1=count($complited);

        $half1=DB::select('select*from tasks where status=2 AND (assignee= ? OR assigned_to= ?)', [$ida,$ida]);
        $half=count($half1);

        $members1=DB::select('select*from users where status=1');
        $members=count($members1);
        $us=DB::select('select*from users');

        return view('home', ['kioko'=>$kioko,'usera'=>$usersa, 'complited1'=>$complited1,'half'=>$half,'members'=>$members,'us'=>$us]);
    }

     public function deletetasks(Request $request)
    {
        
        $id=request()->id;
        $kiok=DB::update('delete from tasks where id=?',[$id]);
        return redirect()->back();
    }

  
    public function edittask(Request $request)
    {
        $ida=request()->id;
        $edittask=DB::select('select users.id,users.name, users.status,tasks.taskname, tasks.id as ida,tasks.description,tasks.urgency, tasks.comments, tasks.assigned_to,tasks.due_date  FROM tasks JOIN  users ON users.id=tasks.assigned_to where tasks.id= ?', [$ida]);

        
      
        $option=DB::select('select*from users');

        return view('edittasks', ['kioko1'=>$edittask,'option'=>$option]);
    }

    public function assigntask(Request $request)
    {
        $ida=request()->id;
       $assigntask=DB::select('select users.id,users.name, users.status,tasks.taskname, tasks.id as ida,tasks.description,tasks.urgency, tasks.comments, tasks.assigned_to,tasks.due_date,tasks.status as statu  FROM tasks JOIN  users ON users.id=tasks.assigned_to where tasks.id= ?', [$ida]);
        $option=DB::select('select*from users');
       

       return view('assigntask', ['kioko1'=>$assigntask,'option'=>$option]);
    }



 public function assigntasks(Request $request)
{
    $id = $request->input('code');
    
    $status = $request->input('urgency');
    $taskname = $request->input('taskname');

      $kiok=DB::update('update tasks set status= ? where id=?',[$status,$id]);
       

    return redirect()->route('home')->with('success', 'Task status updated successfully');
}


public function edittasks(Request $request)
{
  
    $validatedData = $request->validate([
        'taskname' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'urgency' => 'required|in:0,1,2', 
        'comments' => 'required|string|max:255',
        'assigned_to' => 'required|string|max:255',
        'due_date' => 'required|date',
    ]);

   
    $id = $request->input('code');

    
    $updated = DB::table('tasks')
        ->where('id', $id)
        ->update($validatedData);

    if ($updated) {
        return redirect()->back()->with('message', "Task has been updated successfully");
    } else {
        return redirect()->back()->with('error', "Failed to update task");
    }
}


      

    
}
