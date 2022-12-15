@extends('layouts.app', ['page' => __('View Task'), 'pageSlug' => 'view-task'])

@section('pagetitle')
View Task
@endsection

@section('breadcrumbs')
  <li class="breadcrumb-item text-muted">
    <a href="/">Home</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">
    <a href="/tasks-list">Task Management</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">View Task</li>
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
  <form id="add_worker" method="post" action="/save-task">
  <div class="card-body p-9">
    {{ csrf_field() }}
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="as_worker_id" class="form-label">Assgined To</label>
        <select name="as_worker_id" disabled="" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Worker">
            @foreach( $workers as $v )
                <option value="{{ $v->id }}" @if($v->id == $task->as_worker_id) {{ 'selected' }} @endif >{{ $v->id }} - {{ $v->name }}</option>
            @endforeach
        </select>
      </div>
      <div class="col-9 mb-10">
        <label for="as_title" class="form-label">Task Title</label>
        <input type="text" readonly="" name="as_title" class="form-control form-control-solid" value="{{$task->as_title}}"/>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="as_title" class="form-label">Task Type</label>
        <div class="form-check form-check-custom form-check-solid form-check-sm mb-3">
          <input class="form-check-input" readonly="" type="radio" value="0" name="as_status" id="entireZip" @if($task->as_status==0) {{'checked'}} @endif  />
          <label class="form-check-label" for="entireZip">
              Entire Zip Code Region
          </label>
        </div>
        <div class="form-check form-check-custom form-check-solid form-check-sm mb-3">
          <input class="form-check-input" readonly="" type="radio" value="1" name="as_status" id="specificNeighborhood" @if($task->as_status==1) {{'checked'}} @endif />
          <label class="form-check-label" for="specificNeighborhood">
              Specific Neighborhood
          </label>
        </div>
      </div>
      <div class="col-3 mb-10">
        <label for="as_title" class="form-label">Priority</label>
        <div class="form-check form-check-custom form-check-success form-check-sm mb-3">
          <input class="form-check-input" readonly="" type="radio" value="0" name="as_priority" id="normal_priority"  @if($task->as_priority==0) {{'checked'}} @endif  />
          <label class="form-check-label" for="normal_priority">
              Normal
          </label>
        </div>
        <div class="form-check form-check-custom form-check-danger form-check-sm mb-3">
          <input class="form-check-input" readonly="" type="radio" value="1" name="as_priority" id="urgent_priority" @if($task->as_priority==1) {{'checked'}} @endif />
          <label class="form-check-label" for="urgent_priority">
              Urgent
          </label>
        </div>
      </div>
      <div class="col-2 mb-10">
        <label for="as_zip" class="form-label">Zip Code</label>
        <input type="number" readonly="" name="as_zip" class="form-control form-control-solid" placeholder="Enter zip code" value="{{$task->as_zip}}"/>
      </div>
      <div class="col-4 mb-10">
        <label for="as_neighborhood" class="form-label">Neighborhood Focus</label>
        <input type="text" readonly="" name="as_neighborhood" class="form-control form-control-solid" placeholder="Enter neighborhood focus" value="{{$task->as_neighborhood}}"/>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="as_lat" class="form-label">Latitude (Optional)</label>
        <input type="text" readonly="" name="as_lat" class="form-control form-control-solid" value="{{$task->as_lat}}"/>
      </div>
      <div class="col-3 mb-10">
        <label for="as_lng" class="form-label">Longitude (Optional)</label>
        <input type="text" readonly="" name="as_lng" class="form-control form-control-solid" value="{{$task->as_lng}}"/>
      </div>
      <div class="col-6 mb-10">
        <label for="as_address" class="form-label">Specific Address (Optional)</label>
        <input type="text" readonly="" name="as_address" class="form-control form-control-solid" value="{{$task->as_address}}"/>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="deadline" class="form-label">Deadline</label>
        <input disabled="" class="form-control form-control-solid" value="{{$task->as_deadlilne}}" name="as_deadlilne" placeholder="Pick date as deadline" id="as_deadlilne"/>
      </div>
      <div class="col-9 mb-10">
        <label for="as_attributes" class="form-label">Property Attributes to Focus</label><br />
        <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
            <input readonly="" class="form-check-input" name="as_lawn_area" type="checkbox" value="1" @if($task->as_lawn_area==1) {{'checked'}} @endif />
            <label class="form-check-label" for="as_lawn_area">
                Lawn Area
            </label>
        </div>
        <div class="form-check form-check-custom form-check-warning form-check-solid form-check-inline">
            <input readonly="" class="form-check-input" name="as_roof_area" type="checkbox" value="1" @if($task->as_roof_area==1) {{'checked'}} @endif />
            <label class="form-check-label" for="as_roof_area">
                Roof Area
            </label>
        </div>
        <div class="form-check form-check-custom form-check-primary form-check-solid form-check-inline">
            <input readonly="" class="form-check-input" name="as_roof_pitch" type="checkbox" value="1" @if($task->as_roof_pitch==1) {{'checked'}} @endif />
            <label class="form-check-label" for="as_roof_pitch">
                Roof Pitch
            </label>
        </div>
        <div class="form-check form-check-custom form-check-warning form-check-solid form-check-inline">
            <input readonly="" class="form-check-input" name="as_roof_perimeter" type="checkbox" value="1" @if($task->as_roof_perimeter==1) {{'checked'}} @endif />
            <label class="form-check-label" for="as_roof_perimeter">
                Roof Perimeter
            </label>
        </div>
        <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
            <input readonly="" class="form-check-input" name="as_fence" type="checkbox" value="1" @if($task->as_fence==1) {{'checked'}} @endif />
            <label class="form-check-label" for="as_fence">
                Fence
            </label>
        </div>
        <div class="form-check form-check-custom form-check-danger form-check-solid form-check-inline">
            <input readonly="" class="form-check-input" name="as_driveway" type="checkbox" value="1" @if($task->as_driveway==1) {{'checked'}} @endif />
            <label class="form-check-label" for="as_driveway">
                Driveway / Walkway
            </label>
        </div>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-12 mb-10">
        <div class="rounded border d-flex flex-column p-10">
            <label for="" class="form-label">Comments / Instructions</label>
            <textarea disabled="" readonly="" class="form-control form-control form-control-solid" name="as_comments" data-kt-autosize="true">{{ $task->as_comments }}</textarea>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>
@endsection

@push('js')
<script type="text/javascript">
  $("#as_deadlilne").flatpickr({
      altInput: true,
      enableTime: false,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
    });
</script>
@endpush
