@extends('layouts.app', ['class' => 'login-page', 'page' => __('Login Page'), 'contentClass' => 'login-page'])

@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url({{ asset('keen') }}/media/misc/auth-bg.png)">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                <!--begin::Logo-->
                <!--<a href="#" class="mb-0 mb-lg-20">
                    <img alt="Logo" src="{{ asset('keen') }}/media/logos/LawnProSoftware.png" class="h-40px h-lg-50px" />
                </a>-->
                <!--end::Logo-->
                <!--begin::Image-->
                <!-- <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" src="{{ asset('keen') }}/media/misc/auth-screens.png" alt="" /> -->
                <!--end::Image-->
                <!--begin::Title-->
                <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">PROPERTY ESTIMATOR</h1>
                <!--end::Title-->
                <!--begin::Text-->
                <div class="d-none d-lg-block text-white fs-base text-center">Gives you 360 propety measurements</div>
                <!--end::Text-->
            </div>
            <!--end::Content-->
        </div>
        <!--begin::Form-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
            <!--begin::Wrapper-->
            @if (Session::has('message'))
            <div class="alert alert-default">{{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
            @endif
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                <form class="form" method="post" action="{{ route('login') }}">
                @csrf
                    <!--begin::Heading-->
                    <!--begin::Heading-->
                    <!--begin::Login options-->
                    <!--end::Login options-->
                    <!--begin::Separator-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">Please enter your credentials to access property estimator</div>
                        <!--end::Subtitle=-->
                    </div>
                    <!--end::Separator-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent{{ $errors->has('email') ? ' is-invalid' : '' }}" />
                        @include('alerts.feedback', ['field' => 'email'])
                        <!--end::Email-->
                    </div>
                    <!--end::Input group=-->
                    <div class="fv-row mb-3">
                        <!--begin::Password-->
                        <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent{{ $errors->has('password') ? ' is-invalid' : '' }}" />
                        @include('alerts.feedback', ['field' => 'password'])
                        <!--end::Password-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Wrapper-->
                    <!-- <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8"> -->
                        <!--begin::Link-->
                        <!-- <a href="#" class="link-primary">Forgot Password ?</a> -->
                        <!--end::Link-->
                    <!-- </div> -->
                    <!--end::Wrapper-->
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Log In</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">Don't have access?
                    <a href="#" class="link-primary">Send request to your manager</a></div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('keen') }}/js/custom/authentication/sign-in/general.js"></script>
@endpush
