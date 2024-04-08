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
        $kioko=DB::select('select users.id,users.name, users.status as statu,tasks.taskname, tasks.id as ida,tasks.description,tasks.urgency, tasks.comments, tasks.assigned_to,tasks.due_date, tasks.status  FROM tasks JOIN  users ON users.id=tasks.assigned_to where assignee= ? or assigned_to= ?', [$ida,$ida]);

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
        $ida=Auth::user()->id;
        $edittask=DB::select('select users.id,users.name, users.status,tasks.taskname, tasks.id as ida,tasks.description,tasks.urgency, tasks.comments, tasks.assigned_to,tasks.due_date  FROM tasks JOIN  users ON users.id=tasks.assigned_to where assignee= ? or assigned_to= ?', [$ida,$ida]);

        return view('edittask', ['kioko1'=>$edittask]);
    }

    public function assigntask(Request $request)
    {
        $ida=Auth::user()->id;
       $assigntask=DB::select('select users.id,users.name, users.status,tasks.taskname, tasks.id as ida,tasks.description,tasks.urgency, tasks.comments, tasks.assigned_to,tasks.due_date  FROM tasks JOIN  users ON users.id=tasks.assigned_to where assignee= ? or assigned_to= ?', [$ida,$ida]);
        $option=DB::select('select*from users');
       

       return view('assigntask', ['kioko1'=>$assigntask,'option'=>$option]);
    }

      

    
}
