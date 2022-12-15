@extends('layouts.app', ['page' => __('Reports'), 'pageSlug' => 'reports'])

@section('pagetitle')
Franchise Time Tracking Report
@endsection

@section('breadcrumbs')
  <li class="breadcrumb-item text-muted">
    <a href="/">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">Reports</li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">Franchise Time Tracking Report</li>
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
  <form id="report" method="post" action="">
  <div class="card-body p-9">
    <input type="hidden" id="dateFormat" value="M d, Y">
    <input type="hidden" id="weekstart" value="1">
    <input type="hidden" name="sdate" value="{{$sdate}}" id="sdate">
    <input type="hidden" name="edate" value="{{$edate}}" id="edate">
    {{ csrf_field() }}
    <div class="row mb-6">
      <label class="col-lg-2 col-form-label fw-semibold fs-6">Date Range</label>
      <div class="col-lg-6 fv-row fv-plugins-icon-container">
        <div id="reportrange" class="form-control form-control-lg form-control-solid">
          <i class="tim-icons icon-calendar-60"></i>
          <span></span>
        </div>
      </div>
    </div>
  </div>
    <div class="card-footer d-flex justify-content-end py-6 px-9">
      <button type="submit" class="btn btn-primary">Generate Report</button>
    </div>
  </form>
</div>
@if($timerLogs)
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Franchise Timer Log</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <td>Employee Name</td>
                <td>Franchise #</td>
                <td>Franchise Name</td>
                <td>Login Date</td>
                <td>Login Time</td>
                <td>Time Spent</td>
                <td>Activity</td>
              </tr>
            </thead>
            <tbody>
              @foreach( $timerLogs as $v )
              <tr>
                <td>{{ $v->user_fname }} {{ $v->user_lname }}</td>
                <td>{{ $v->fr_company_id }}</td>
                <td>{{ $v->co_name }}</td>
                <td>{{ \Carbon\Carbon::parse($v->fr_loggedin_at)->format('d/m/Y')}}</td>
                <td>{{ \Carbon\Carbon::parse($v->fr_loggedin_at)->format('h:i:s A')}}</td>
                <td>{{ $v->timespent }}</td>
                <td>{{ $v->fr_category }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

@endsection
