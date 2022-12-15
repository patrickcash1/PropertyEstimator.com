@extends('layouts.app', ['page' => __('Assign New Task'), 'pageSlug' => 'assign-task'])

@section('pagetitle')
Add Property Measurement
@endsection

@section('breadcrumbs')
  <li class="breadcrumb-item text-muted">
    <a href="/">Home</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">
    <a href="/list-properties">Properties Management</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">Add Pproperty Measurement</li>
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
  <form id="add_worker" method="post" enctype="multipart/form-data" action="/save-property">
  <div class="card-body p-9">
    {{ csrf_field() }}
    <input type="hidden" id="tokenForImg" value="{{ csrf_token() }}">
    <div class="row mb-6">
      <div class="col-6 mb-10">
        <label for="mms_address1" class="required form-label">Street Address 1</label>
        <input type="text" name="mms_address1" class="form-control form-control-solid" placeholder="Street address 1 here"/>
      </div>
      <div class="col-6 mb-10">
        <label for="mms_address2" class="form-label">Street Address 2</label>
        <input type="text" name="mms_address2" class="form-control form-control-solid" placeholder="Street address 2 here"/>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-2 mb-10">
        <label for="mms_locality" class="form-label">Locality</label>
        <input type="teaxt" name="mms_locality" class="form-control form-control-solid" placeholder="Enter locality (if any)" />
      </div>
      <div class="col-2 mb-10">
        <label for="mms_town" class="form-label">Town</label>
        <input type="teaxt" name="mms_town" class="form-control form-control-solid" placeholder="Enter town (if any)" />
      </div>
      <div class="col-2 mb-10">
        <label for="mms_city" class="required form-label">City</label>
        <input type="teaxt" name="mms_city" class="form-control form-control-solid" placeholder="Enter city name" />
      </div>
      <div class="col-3 mb-10">
        <label for="mms_state" class="required form-label">State</label>
        <select name="mms_state" class="form-select form-select-solid" data-control="select2" data-placeholder="Select State">
          @include('partials.states')
        </select>
      </div>
      <div class="col-3 mb-10">
        <label for="mms_zip" class="required form-label">Zip</label>
        <input type="teaxt" name="mms_zip" class="form-control form-control-solid" placeholder="Enter zip code" />
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-3 mb-10">
        <label for="mms_lat" class="form-label">Latitude (Optional)</label>
        <input type="text" name="mms_lat" class="form-control form-control-solid" />
      </div>
      <div class="col-3 mb-10">
        <label for="mms_lng" class="form-label">Longitude (Optional)</label>
        <input type="text" name="mms_lng" class="form-control form-control-solid" />
      </div>
      <div class="col-6 mb-10">
        <label for="mms_other" class="form-label">Any Other Address Information (goole maps link etc)</label>
        <input type="text" name="mms_other" class="form-control form-control-solid" />
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-1 mb-10">
        <label for="mms_lawn_area" class="form-label">Lawn Area</label>
        <input type="number" name="mms_lawn_area" class="form-control form-control-solid" />
      </div>
      <div class="col-1 mb-10">
        <label for="mms_roof_area" class="form-label">Roof Area</label>
        <input type="number" name="mms_roof_area" class="form-control form-control-solid" />
      </div>
      <div class="col-1 mb-10">
        <label for="mms_roof_pitch" class="form-label">Roof Pitch</label>
        <input type="number" name="mms_roof_pitch" class="form-control form-control-solid" />
      </div>
      <div class="col-2 mb-10">
        <label for="mms_roof_perimeter" class="form-label">Roof Perimeter</label>
        <input type="number" name="mms_roof_perimeter" class="form-control form-control-solid" />
      </div>
      <div class="col-1 mb-10">
        <label for="mms_fence" class="form-label">Fence</label>
        <select name="mms_fence" class="form-select form-select-solid">
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>
      <div class="col-3 mb-10">
        <label for="mms_driveway_area" class="form-label">Driveway / Walkway Area</label>
        <input type="number" name="mms_driveway_area" class="form-control form-control-solid" />
      </div>
      <div class="col-3 mb-10">
        <label for="mms_stories_num" class="form-label">Number of Stories</label>
        <input type="number" name="mms_stories_num" class="form-control form-control-solid" />
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-12 mb-10">
        <label for="mms_image" class="form-label">Property High Resolution Image</label>
        <br />
        <img id="measuredPictureImg" style="width:300px" src="{{ asset('keen') }}/media/img_not_found.png" class="card-img-top mb-3" alt="...">
        <div class="spinner-border text-primary loadingAnimation mt-3 mb-3" role="status" style="display: block; margin-left: auto; margin-right: auto;">
            <span class="sr-only">Loading...</span>
        </div>
        <input type="hidden" id="measuredPictureId" name="measuredPictureId" value="" />
        <div class="uploadFileContainer" style="display: none;">
            <input type="file" class="measured-upload-pond" name="uploaded_file" />
        </div>
      </div>
    </div>
    <div class="row mb-6">
      <div class="col-12 mb-10">
        <div class="rounded border d-flex flex-column p-10">
            <label for="" class="form-label">Comments (if there was any issue during measurements etc)</label>
            <textarea class="form-control form-control form-control-solid" name="mms_comments" data-kt-autosize="true"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer d-flex justify-content-end py-6 px-9">
    <button type="submit" class="btn btn-primary">Save Property Measurement</button>
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
//   var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
//     url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
//     paramName: "file", // The name that will be used to transfer the file
//     maxFiles: 10,
//     maxFilesize: 10, // MB
//     addRemoveLinks: true,
//     accept: function(file, done) {
//         if (file.name == "wow.jpg") {
//             done("Naha, you don't.");
//         } else {
//             done();
//         }
//     }
// });
</script>
<script src="https://unpkg.com/filepond"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="{{ asset('keen') }}/js/filepond/filepond-plugin-file-poster.js"></script>
<script src="{{ asset('keen') }}/js/filepond/filepond-plugin-file-validate-type.js"></script>
<script src="{{ asset('keen') }}/js/filepond/filepond-plugin-image-editor/FilePondPluginImageEditor.js"></script>
<script type="module" src="{{ asset('keen') }}/js/filepond/instance.js"></script>
@endpush
