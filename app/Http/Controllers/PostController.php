<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Assignment;
use App\Models\Measurement;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function index()
    {
        return view('pages.reports');
    }

    public function storetask(Request $request)
    {
// $allSessions = session()->all();
//         dd($allSessions);die;
        if(empty($request->as_worker_id)){
            throw ValidationException::withMessages(['as_worker_id' => 'Please select a worker']);
        }

        if(empty($request->as_title)){
            throw ValidationException::withMessages(['as_title' => 'Please enter task title']);
        }

        $newtask = Assignment::create([
            'as_title'          => $request->as_title,
            'as_address'        => $request->as_address,
            'as_zip'            => $request->as_zip,
            'as_neighborhood'   => $request->as_neighborhood,
            'as_worker_id'      => $request->as_worker_id,
            'as_priority'       => (!$request->as_priority) ? 0 : $request->as_priority,
            'as_comments'       => $request->as_comments,
            'as_status'         => (!$request->as_status) ? 0 : $request->as_status,
            'as_added_by_user'  => session()->get('worker_id'),
            'as_entered_at'     => date('Y-m-d H:i:s'),
            'as_deadlilne'      => $request->as_deadlilne,
            'as_lawn_area'      => (!$request->as_lawn_area) ? 0 : $request->as_lawn_area,
            'as_roof_area'      => (!$request->as_roof_area) ? 0 : $request->as_roof_area,
            'as_roof_pitch'     => (!$request->as_roof_pitch) ? 0 : $request->as_roof_pitch,
            'as_roof_perimeter' => (!$request->as_roof_perimeter) ? 0 : $request->as_roof_perimeter,
            'as_fence'          => (!$request->as_fence) ? 0 : $request->as_fence,
            'as_driveway'       => (!$request->as_driveway) ? 0 : $request->as_driveway,
            'as_lat'            => $request->as_lat,
            'as_lng'            => $request->as_lng,
            'as_img'            => $request->assignedPictureId
        ]);
        

        $tasks = Assignment::whereIn('as_status', array(0,1))->get();

        $data  = array(
            'tasks'     => $tasks
        );

        return redirect()->route( 'pages.taskslist' )->with($data);
    }

    public function storeproperty(Request $request)
    {
        $stateCode = '';
        $stateName = '';

        if($request->mms_state){
            $chunk = explode('-', $request->mms_state);
            $stateCode = $chunk[0];
            $stateName = $chunk[1];
        }

        $newmeasurement = Measurement::create([
            'mms_entered_by_user'  => session()->get('worker_id'),
            'mms_address1'         => $request->mms_address1,
            'mms_address2'         => $request->mms_address2, 
            'mms_locality'         => $request->mms_locality, 
            'mms_town'             => $request->mms_town, 
            'mms_city'             => $request->mms_city, 
            'mms_state'            => $stateName, 
            'mms_state_code'       => $stateCode, 
            'mms_country_name'     => 'United States',
            'mms_country_code'     => 'US', 
            'mms_zip'              => $request->mms_zip, 
            'mms_lat'              => $request->mms_lat, 
            'mms_lng'              => $request->mms_lng, 
            'mms_other'            => $request->mms_other, 

            'mms_property_size'    => $request->mms_property_size,
            'mms_property_size_unit' => $request->mms_property_size_unit,

            'mms_house_size'        => $request->mms_house_size,
            'mms_house_size_unit'   => $request->mms_house_size_unit,

            'mms_paved_area'        => $request->mms_paved_area,
            'mms_paved_area_unit'   => $request->mms_paved_area_unit,

            'mms_planting_area'     => $request->mms_planting_area,
            'mms_planting_area_unit'=> $request->mms_planting_area_unit,

            'mms_lawn_area'         => $request->mms_lawn_area,
            'mms_lawn_area_unit'    => $request->mms_lawn_area_unit,

            'mms_front_width'       => $request->mms_front_width,
            'mms_front_width_unit'  => $request->mms_front_width_unit,

            'mms_roof_area'         => $request->mms_roof_area, 
            'mms_roof_area_unit'    => $request->mms_roof_area_unit,

            'mms_roof_pitch'        => $request->mms_roof_pitch, 

            'mms_roof_perimeter'    => $request->mms_roof_perimeter, 
            'mms_roof_perimeter_unit'  => $request->mms_roof_perimeter_unit,

            'mms_driveway_area'     => $request->mms_driveway_area, 
            'mms_driveway_area_unit'  => $request->mms_driveway_area_unit,

            'mms_fence'             => $request->mms_fence, 
            'mms_stories_num'       => $request->mms_stories_num,
            
            'mms_img'               => $request->measuredPictureId,
            'mms_img_front'         => $request->frontPictureId,
            'mms_img_satellite'     => $request->satellitePictureId,

            'mms_comments'          => $request->mms_comments, 
            'mms_entered_at'        => date('Y-m-d H:i:s')
        ]);
        

        $measurements = Measurement::where('mms_entered_by_user', session()->get('worker_id'))->get();

        $data  = array(
            'measurements'     => $measurements
        );

        return redirect()->route( 'pages.measurementslist' )->with($data);
    }

    public function timelog(Request $request)
    {
    	$sdate = $request->sdate;
    	$edate = $request->edate .' 23:59:59';
    	$co_id = session()->get('co_id');

        $timerLogs = DB::table('franchise_login')
        	->select('user_fname', 'user_lname', 'fr_company_id', 'co_name', 'fr_loggedin_at', 'fr_loggedout_at', 'fr_category')
        	->leftJoin('command_center_log', 'franchise_login.fr_ccl_id', '=', 'command_center_log.ccl_id')
        	->leftJoin('company', 'franchise_login.fr_company_id', '=', 'company.co_id')
        	->leftJoin('users', 'franchise_login.fr_user_id', '=', 'users.user_id')
            ->where('franchise_login.fr_loggedin_at', '>=', $sdate)
            ->where('franchise_login.fr_loggedin_at', '<=', $edate)
            ->where('command_center_log.ccl_company_id', '=', $co_id)
            ->get();

        foreach ($timerLogs as $time) {
            $timeLoggedIn = $time->fr_loggedin_at;
            $timeLoggedOut = $time->fr_loggedout_at;
            $time->timespent = $this->getTimeSpent($timeLoggedIn,$timeLoggedOut)['spent'];
		}

        $data  = array(
            'timerLogs'     => $timerLogs,
            'sdate'         => $request->sdate,
            'edate'         => $request->edate
        );
        return view('pages.reports')->with($data);  
    }

    public function getTimeSpent($franchiseLoginTime = 0, $stopTimestamp = null){
        if (!empty(session()->get('user_timezone'))) {
            date_default_timezone_set(session()->get('user_timezone'));
        }
        else{
            date_default_timezone_set('America/Chicago');
        }

        if(empty($stopTimestamp)){ 
            $stopTimestamp = time();
        }
        else
            $stopTimestamp = strtotime($stopTimestamp);

        $startTimestamp = strtotime($franchiseLoginTime);
        $durationInSeconds = $stopTimestamp - $startTimestamp;
        $hours          = floor(($durationInSeconds / 3600) % 60);
        $minutes        = floor(($durationInSeconds / 60) % 60);
        $seconds        = ($durationInSeconds - ($hours * 3600) - ($minutes * 60));
        $res['hours']   = $hours;
        $res['minutes'] = $minutes;
        $res['seconds'] = $seconds;
        $res['spent']   = $hours . ':' . $minutes . ':' . $seconds; 
        return $res;
    }
}
