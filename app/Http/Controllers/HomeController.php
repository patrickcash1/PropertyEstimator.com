<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(session()->get('worker_role') < 1){
            $totalMeasurements = DB::table('measurements')
                ->where('mms_entered_by_user',session()->get('worker_id'))
                ->count();
            $allWorkers = DB::table('measurements')
                ->join('users', 'users.id', '=', 'measurements.mms_entered_by_user')
                ->select('name', DB::raw('COUNT(*) as totalMeasurement'), DB::raw('(COUNT(*) * 0.2) as totalCost'))
                ->where('mms_entered_by_user',session()->get('worker_id'))
                ->groupBy('measurements.mms_entered_by_user')
                ->get();
        }
        else{
            $totalMeasurements = DB::table('measurements')->count();
            $allWorkers = DB::table('measurements')
                ->join('users', 'users.id', '=', 'measurements.mms_entered_by_user')
                ->select('name', DB::raw('COUNT(*) as totalMeasurement'), DB::raw('(COUNT(*) * 0.2) as totalCost'))
                ->groupBy('measurements.mms_entered_by_user')
                ->get();
        }

        $data  = array(
            'totalMeasurements'     => $totalMeasurements,
            'costMeasurements'      => floatval($totalMeasurements * 0.2),
            'allWorkers'            => $allWorkers,
        );
        return view('dashboard')->with($data);
    }
}
