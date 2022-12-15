@extends('layouts.app', ['page' => __('Assign New Task'), 'pageSlug' => 'assign-task'])

@section('pagetitle')
Assign New Task
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
  <li class="breadcrumb-item text-muted">Assign New Task</li>
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
  <form id="add_worker" method="post" enctype="multipart/form-data" action="/save-task">
    <input type="hidden" id="tokenForImg" value="{{ csrf_token() }}">
  <div class="card-body p-9">
    {{ csrf_field() }}
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="as_worker_id" class="required form-label">Assgined to Worker</label>
        <select name="as_worker_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Worker">
            @foreach( $workers as $v )
                <option value="{{ $v->id }}">{{ $v->id }} - {{ $v->name }}</option>
            @endforeach
        </select>
      </div>
      <div class="col-9 mb-10">
        <label for="as_title" class="required form-label">Task Title</label>
        <input type="text" name="as_title" class="form-control form-control-solid" placeholder="Task title here"/>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="as_title" class="form-label">Task Type</label>
        <div class="form-check form-check-custom form-check-solid form-check-sm mb-3">
          <input class="form-check-input" type="radio" value="0" name="as_status" id="entireZip"  />
          <label class="form-check-label" for="entireZip">
              Entire Zip Code Region
          </label>
        </div>
        <div class="form-check form-check-custom form-check-solid form-check-sm mb-3">
          <input class="form-check-input" type="radio" value="1" name="as_status" id="specificNeighborhood"  />
          <label class="form-check-label" for="specificNeighborhood">
              Specific Neighborhood
          </label>
        </div>
      </div>
      <div class="col-3 mb-10">
        <label for="as_title" class="form-label">Priority</label>
        <div class="form-check form-check-custom form-check-success form-check-sm mb-3">
          <input class="form-check-input" type="radio" value="0" name="as_priority" id="normal_priority" checked=""  />
          <label class="form-check-label" for="normal_priority">
              Normal
          </label>
        </div>
        <div class="form-check form-check-custom form-check-danger form-check-sm mb-3">
          <input class="form-check-input" type="radio" value="1" name="as_priority" id="urgent_priority"  />
          <label class="form-check-label" for="urgent_priority">
              Urgent
          </label>
        </div>
      </div>
      <div class="col-2 mb-10">
        <label for="as_zip" class="form-label">Zip Code</label>
        <input type="number" name="as_zip" class="form-control form-control-solid" placeholder="Enter zip code" />
      </div>
      <div class="col-4 mb-10">
        <label for="as_neighborhood" class="form-label">Neighborhood Focus</label>
        <input type="text" name="as_neighborhood" class="form-control form-control-solid" placeholder="Enter neighborhood focus" />
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="as_lat" class="form-label">Latitude (Optional)</label>
        <input type="text" name="as_lat" class="form-control form-control-solid" />
      </div>
      <div class="col-3 mb-10">
        <label for="as_lng" class="form-label">Longitude (Optional)</label>
        <input type="text" name="as_lng" class="form-control form-control-solid" />
      </div>
      <div class="col-6 mb-10">
        <label for="as_address" class="form-label">Specific Address (Optional)</label>
        <input type="text" name="as_address" class="form-control form-control-solid" />
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="deadline" class="form-label">Deadline</label>
        <input class="form-control form-control-solid" name="as_deadlilne" placeholder="Pick date as deadline" id="as_deadlilne"/>
      </div>
      <div class="col-9 mb-10">
        <label for="as_attributes" class="form-label">Property Attributes to Focus</label><br />
        <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
            <input class="form-check-input" name="as_lawn_area" type="checkbox" value="1" checked />
            <label class="form-check-label" for="as_lawn_area">
                Lawn Area
            </label>
        </div>
        <div class="form-check form-check-custom form-check-warning form-check-solid form-check-inline">
            <input class="form-check-input" name="as_roof_area" type="checkbox" value="1" checked />
            <label class="form-check-label" for="as_roof_area">
                Roof Area
            </label>
        </div>
        <div class="form-check form-check-custom form-check-primary form-check-solid form-check-inline">
            <input class="form-check-input" name="as_roof_pitch" type="checkbox" value="1" checked />
            <label class="form-check-label" for="as_roof_pitch">
                Roof Pitch
            </label>
        </div>
        <div class="form-check form-check-custom form-check-warning form-check-solid form-check-inline">
            <input class="form-check-input" name="as_roof_perimeter" type="checkbox" value="1" checked />
            <label class="form-check-label" for="as_roof_perimeter">
                Roof Perimeter
            </label>
        </div>
        <div class="form-check form-check-custom form-check-success form-check-solid form-check-inline">
            <input class="form-check-input" name="as_fence" type="checkbox" value="1" checked />
            <label class="form-check-label" for="as_fence">
                Fence
            </label>
        </div>
        <div class="form-check form-check-custom form-check-danger form-check-solid form-check-inline">
            <input class="form-check-input" name="as_driveway" type="checkbox" value="1" checked />
            <label class="form-check-label" for="as_driveway">
                Driveway / Walkway
            </label>
        </div>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-12 mb-10">
        <label for="mms_image" class="form-label">Property High Resolution Image</label>
        <br />
        <img id="assignedPictureImg" style="width:300px" src="{{ asset('keen') }}/media/img_not_found.png" class="card-img-top mb-3" alt="...">
        <div class="spinner-border text-primary loadingAnimation mt-3 mb-3" role="status" style="display: block; margin-left: auto; margin-right: auto;">
            <span class="sr-only">Loading...</span>
        </div>
        <input type="hidden" id="assignedPictureId" name="assignedPictureId" value="" />
        <div class="uploadFileContainer" style="display: none;">
            <input type="file" class="assigned-upload-pond" name="uploaded_file" />
        </div>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-12 mb-10">
        <div class="rounded border d-flex flex-column p-10">
            <label for="" class="form-label">Comments / Instructions</label>
            <textarea class="form-control form-control form-control-solid" name="as_comments" data-kt-autosize="true"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer d-flex justify-content-end py-6 px-9">
    <button type="submit" class="btn btn-primary">Save Task</button>
  </div>
  </form>
</div>
@endsection

@push('css')
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
  <link href="{{ asset('keen') }}/css/pintura/pintura.css" rel="stylesheet" type="text/css"/>
  <style>
      .filepond--panel-root {
          background-color: #F8F8FF;
          border: 2px dashed #CCCCCC;
      }
  </style>
@endpush

@push('js')
<script type="text/javascript">
  $("#as_deadlilne").flatpickr({
      altInput: true,
      enableTime: false,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
    });
</script>
<script src="https://unpkg.com/filepond"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="{{ asset('keen') }}/js/filepond/filepond-plugin-file-poster.js"></script>
<script src="{{ asset('keen') }}/js/filepond/filepond-plugin-file-validate-type.js"></script>
<script src="{{ asset('keen') }}/js/filepond/filepond-plugin-image-editor/FilePondPluginImageEditor.js"></script>
<script type="module" src="{{ asset('keen') }}/js/filepond/instanceassigned.js"></script>
@endpush
