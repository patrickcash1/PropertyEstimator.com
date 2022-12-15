<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Measurement;

class PageController extends Controller
{
    /**
     * Display workers list page
     *
     * @return \Illuminate\View\View
     */
    public function workerslist()
    { 

        if(!$this->checkPermissions())
            return back()->with('jsAlert', 'Sorry! You are not allowed to access that desired page.');

        $workers = DB::table('users')
                    ->get();

        $data  = array(
            'workers' => $workers,
        );

        return view('pages.workerslist')->with($data);
    }

    /**
     * Display Assign Task page
     *
     * @return \Illuminate\View\View
     */
    public function assigntask()
    {
        if(!$this->checkPermissions())
            return back()->with('jsAlert', 'Sorry! You are not allowed to access that desired page.');

        $workers = DB::table('users')
                    ->where('role', '=', 0)
                    ->get();

        $data  = array(
            'workers' => $workers,
        );

        return view('pages.assigntask')->with($data);
    }

    /**
     * Display Assign Task page
     *
     * @return \Illuminate\View\View
     */
    public function viewtask(Request $request)
    {   
        $task = Assignment::find($request->id);

        $workers = DB::table('users')
                    ->where('role', '=', 0)
                    ->get();

        $data  = array(
            'workers'   => $workers,
            'task'      => $task
        );

        return view('pages.viewtask')->with($data);
    }

    /**
     * Display Add Property Measurement page
     *
     * @return \Illuminate\View\View
     */
    public function addmeasurement()
    {
        $workers = DB::table('users')
                    ->where('role', '=', 0)
                    ->get();

        $data  = array(
            'workers' => $workers,
        );

        return view('pages.addmeasurement')->with($data);
    }

    /**
     * Display Task List page
     *
     * @return \Illuminate\View\View
     */
    public function taskslist()
    {   
        if(session()->get('worker_role') < 1){
        $tasks = Assignment::whereIn('as_status', array(0,1))
                            ->where('as_worker_id',session()->get('worker_id'))
                            ->get();
        }
        else{
            $tasks = Assignment::whereIn('as_status', array(0,1))->get();
        }

        $data  = array(
            'tasks'     => $tasks
        );

        return view('pages.taskslist')->with($data); 
    }

    /**
     * Display Measurements List page
     *
     * @return \Illuminate\View\View
     */
    public function measurementslist()
    {   
        if(session()->get('worker_role') < 1){
            $measurements = Measurement::where('mms_entered_by_user', session()->get('worker_id'))->get();
        }
        else{
            $measurements = Measurement::where('mms_status', 0)->get();
        }
        $data  = array(
            'measurements'     => $measurements
        );

        return view('pages.measurementslist')->with($data); 
    }

    /**
     * Display reports page
     *
     * @return \Illuminate\View\View
     */
    public function reports()
    {
        if(!$this->checkPermissions())
            return back()->with('jsAlert', 'Sorry! You are not allowed to access that desired page.');

        $data  = array(
            'timerLogs'     => false,
            'sdate'         => date("Y-m-d", strtotime('yesterday')),
            'edate'         => date("Y-m-d")
        );
        return view('pages.reports')->with($data);
    }

    public function checkPermissions(){
        if(session()->get('worker_role') < 1)
            return false;
        return true;
    }
}
