@extends('layouts.app', ['page' => __('Measurements List'), 'pageSlug' => 'measurements-list'])

@section('pagetitle')
Measurements List
@endsection

@section('breadcrumbs')
  <li class="breadcrumb-item text-muted">
    <a href="/">Home</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">Measurements List</li>
@endsection

@section('content')
@if($measurements)
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
          <!--begin::Search-->
          <div class="d-flex align-items-center position-relative my-1">
            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
              </svg>
            </span>
            <!--end::Svg Icon-->
            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Measurements" />
          </div>
          <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
          <!--begin::Toolbar-->
          <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
            <!--begin::Filter-->
            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
            <span class="svg-icon svg-icon-2">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
              </svg>
            </span>
            <!--end::Svg Icon-->Filter</button>
            <!--begin::Menu 1-->
            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
              <!--begin::Header-->
              <div class="px-7 py-5">
                <div class="fs-5 text-dark fw-bold">Filter Options</div>
              </div>
              <!--end::Header-->
              <!--begin::Separator-->
              <div class="separator border-gray-200"></div>
              <!--end::Separator-->
              <!--begin::Content-->
              <div class="px-7 py-5" data-kt-user-table-filter="form">
                <!--begin::Input group-->
                <div class="mb-10">
                  <label class="form-label fs-6 fw-semibold">Priority:</label>
                  <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                    <option></option>
                    <option value="Normal">Normal</option>
                    <option value="Urgent">Urgent</option>
                  </select>
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="d-flex justify-content-end">
                  <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                  <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                </div>
                <!--end::Actions-->
              </div>
              <!--end::Content-->
            </div>
            <!--end::Menu 1-->
            <!--end::Filter-->
            <!--begin::Export-->
            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
            <span class="svg-icon svg-icon-2">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />
                <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />
                <path opacity="0.3" d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="currentColor" />
              </svg>
            </span>
            <!--end::Svg Icon-->Export</button>
            <!--end::Export-->
            <!--begin::Add user-->
            <a href="/add-measurement" class="btn btn-primary">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
            <span class="svg-icon svg-icon-2">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
              </svg>
            </span>
            <!--end::Svg Icon-->Add New Measurement</a>
            <!--end::Add user-->
          </div>
          <!--end::Toolbar-->
          <!--begin::Group actions-->
          <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
            <div class="fw-bold me-5">
            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
          </div>
          <!--end::Group actions-->
          <!--begin::Modal - Adjust Balance-->
          <!--end::Modal - New Card-->
        </div>
        <!--end::Card toolbar-->
      </div>
      <div class="card-body">
          <div id="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
              <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
                <thead class=" text-primary">
                  <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                      <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                      </div>
                    </th>
                    <th>ID</th>
                    <th>Address</th>
                    <th>Property Size</th>
                    <th>House Size</th>
                    <th>Paved Areas</th>
                    <th>Planting Areas</th>
                    <th>Lawn Area</th>
                    <th>Roof Area</th>
                    <th>Roof Pitch</th>
                    <th>Roof Perimeter</th>
                    <th>Driveway</th>
                    <th>Fence</th>
                    <th>Front Width</th>
                    <th>Stories</th>
                    <th>Front Image</th>
                    <th>Satellite Image</th>
                    <th>Measured Image</th>
                    <th>Measured By</th>
                    <th>Measured On</th>
                  </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                  @foreach( $measurements as $v )
                  <tr>
                    <td>
                      <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" />
                      </div>
                    </td>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->mms_address1 }} {{ $v->mms_address2 }}, {{ $v->mms_locality }}, {{ $v->mms_town }}, {{ $v->mms_city }} {{ $v->mms_state_code }} {{ $v->mms_zip }}</td>

                    <td>{{ $v->mms_property_size }} @if($v->mms_property_size_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_house_size }} @if($v->mms_house_size_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_paved_area }} @if($v->mms_paved_area_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_planting_area }} @if($v->mms_planting_area_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_lawn_area }} @if($v->mms_lawn_area_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_roof_area }} @if($v->mms_roof_area_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_roof_pitch }}</td>
                    <td>{{ $v->mms_roof_perimeter }} @if($v->mms_roof_perimeter_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_driveway_area }} @if($v->mms_driveway_area_unit) sqft @else sqm @endif</td>
                    <td>
                      @if($v->mms_fence == 1)
                      <div class="badge badge-success fw-bold">Yes</div>
                      @else
                      <div class="badge badge-danger fw-bold">No</div>
                      @endif
                    </td>
                    <td>{{ $v->mms_front_width }} @if($v->mms_front_width_unit) sqft @else sqm @endif</td>
                    <td>{{ $v->mms_stories_num }}</td>
                    <td><a href="/uploaded_file/{{ $v->mms_img_front }}"><img src="/uploaded_file/{{ $v->mms_img_front }}" alt="Property Image" width="100" height="100"></a></td>
                    <td><a href="/uploaded_file/{{ $v->mms_img_satellite }}"><img src="/uploaded_file/{{ $v->mms_img_satellite }}" alt="Property Image" width="100" height="100"></a></td>
                    <td><a href="/uploaded_file/{{ $v->mms_img }}"><img src="/uploaded_file/{{ $v->mms_img }}" alt="Property Image" width="100" height="100"></a></td>                    
                    <td>{{ $v->mms_entered_by_user }}</td>
                    <td>{{ \Carbon\Carbon::parse($v->mms_entered_at)->format('d/m/Y')}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@else
<h3>Sorry no measurement is found</h3>
@endif
@endsection

@push('js')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('keen') }}/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('keen') }}/js/custom/apps/user-management/users/list/table.js"></script>
<script src="{{ asset('keen') }}/js/custom/apps/user-management/users/list/export-users.js"></script>
<!-- <script src="{{ asset('keen') }}/js/custom/apps/user-management/users/list/add.js"></script> -->
<script src="{{ asset('keen') }}/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
@endpush
