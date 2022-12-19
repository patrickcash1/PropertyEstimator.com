@extends('layouts.app', ['page' => __('Reports'), 'pageSlug' => 'reports'])

@section('pagetitle')
Add New Worker
@endsection

@section('breadcrumbs')
  <li class="breadcrumb-item text-muted">
    <a href="/">Home</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">
    <a href="/workers-list">Workers</a>
  </li>
  <li class="breadcrumb-item">
    <span class="bullet bg-gray-400 w-5px h-2px"></span>
  </li>
  <li class="breadcrumb-item text-muted">Add New Worker</li>
@endsection

@section('content')
<div class="card mb-5 mb-xl-10">
  <form id="add_worker" method="post" action="/store-worker">
  <div class="card-body p-9">
    {{ csrf_field() }}
    <div class="row mb-6">
      <div class="col-6 mb-10">
        <label for="name" class="required form-label">Worker's Name</label>
        <input type="text" name="name" class="form-control form-control-solid" placeholder="Worker's Full Name"/>
      </div>
      <div class="col-6 mb-10">
        <label for="email" class="required form-label">Worker's Email</label>
        <input type="email" name="email" class="form-control form-control-solid" placeholder="Worker's Email Address"/>
      </div>
      <div class="col-6 mb-10">
        <label for="password" class="required form-label">Worker's Password (Default 123456)</label>
        <input type="password" name="password" class="form-control form-control-solid" value="123456"/>
      </div>
      <div class="col-6 mb-10">
        <label for="pay_rate" class="required form-label">Worker's Pay Rate</label>
        <input type="text" name="pay_rate" class="form-control form-control-solid" placeholder="0.20"/>
      </div>
    </div>
  </div>
  <div class="card-footer d-flex justify-content-end py-6 px-9">
    <button type="submit" class="btn btn-primary">Save Worker</button>
  </div>
  </form>
</div>
@endsection
