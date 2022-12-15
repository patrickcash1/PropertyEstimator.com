@extends('layouts.app', ['page' => __('Franchise Login'), 'pageSlug' => 'franchiselogin'])

@section('pagetitle')
Franchise Login
@endsection

@section('breadcrumbs')
  <li class="breadcrumb-item text-muted">
    <a href="/">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">Franchise Login</li>
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
  <div class="card-body p-9">
    <form method="post" action="{{ env('FRANCHISE_LOGIN_URL')}}/login/sub-account-login">
      {{ csrf_field() }}
      <input type="hidden" name="master_id" value="{{ Session::get('co_id') }}">
      <input type="hidden" name="secret" value="{{ Session::get('_token') }}">
      <input type="hidden" name="wk_id" value="{{ Session::get('uid') }}">
      <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Choose Franchise</label>
        <div class="col-lg-8 fv-row fv-plugins-icon-container">
          <select name="choose_franchise" id="choose_franchise" aria-label="Select a Franchise" data-control="select2" data-placeholder="date_period" class="form-select form-select-lg form-select-solid">
              <option value="0">Select Franchise</option>
              @foreach( $franchiseList as $f )
                  <option value="{{ $f->co_id }}">{{ $f->co_id }} - {{ $f->co_name }}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-6">
        <label class="col-lg-4 col-form-label fw-semibold fs-6">Choose Category/Page</label>
        <div class="col-lg-8 fv-row fv-plugins-icon-container">
          <select name="choose_category" id="choose_category" aria-label="Select a Category" data-control="select2" data-placeholder="date_period" class="form-select form-select-lg form-select-solid">
              <option value="0">Select Category/Page</option>
              @foreach( $categoryList as $c )
                  <option value="{{ $c['page_path'] }}">{{ $c['page_name'] }}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="submit" class="btn btn-primary">Login to Franchise</button>
      </div>
    </form>
  </div>
</div>
@endsection
