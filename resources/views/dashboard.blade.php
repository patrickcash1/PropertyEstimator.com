 @extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<!--begin::Row-->
<div class="row" style="min-height: 500px">
    <!--begin::Col-->
    <div class="col-md-6 mb-10">
        <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10" style="background-color: #3E97FF;background-image:url('{{ asset('keen') }}/media/svg/shapes/widget-bg-1.png')">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <div class="card-title d-flex flex-column">
                    <!--begin::Amount-->
                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">50</span>
                    <!--end::Amount-->
                    <!--begin::Subtitle-->
                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Properties measured in December 2022</span>
                    <!--end::Subtitle-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                        <span>Cost of Measurements</span>
                        <span>$10.00</span>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-md-6 mb-10">
        <!--begin::Card widget 17-->
        <div class="card card-flush h-md-50 mb-5 mb-xl-10">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <div class="card-title d-flex flex-column">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center">
                        <!--begin::Currency-->
                        <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                        <!--end::Currency-->
                        <!--begin::Amount-->
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">10.00 / 50 Properties</span>
                        <!--end::Amount-->
                        <!--begin::Badge-->
                        <!--end::Badge-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Subtitle-->
                    <span class="text-gray-400 pt-1 fw-semibold fs-6">Total spent this year to date on measurements</span>
                    <!--end::Subtitle-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                <!--begin::Chart-->
                <div class="d-flex flex-center me-5 pt-2">
                    <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                </div>
                <!--end::Chart-->
                <!--begin::Labels-->
                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                    <!--begin::Label-->
                    <div class="d-flex fw-semibold align-items-center">
                        <!--begin::Bullet-->
                        <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                        <!--end::Bullet-->
                        <!--begin::Label-->
                        <div class="text-gray-500 flex-grow-1 me-4">Fakhir</div>
                        <!--end::Label-->
                        <!--begin::Stats-->
                        <div class="fw-bolder text-gray-700 text-xxl-end">$5.00 / 25 Properties</div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Label-->
                    <!--begin::Label-->
                    <div class="d-flex fw-semibold align-items-center my-3">
                        <!--begin::Bullet-->
                        <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                        <!--end::Bullet-->
                        <!--begin::Label-->
                        <div class="text-gray-500 flex-grow-1 me-4">John Doe</div>
                        <!--end::Label-->
                        <!--begin::Stats-->
                        <div class="fw-bolder text-gray-700 text-xxl-end">$3.00 / 15 Properties</div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Label-->
                    <!--begin::Label-->
                    <div class="d-flex fw-semibold align-items-center">
                        <!--begin::Bullet-->
                        <div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                        <!--end::Bullet-->
                        <!--begin::Label-->
                        <div class="text-gray-500 flex-grow-1 me-4">Usman</div>
                        <!--end::Label-->
                        <!--begin::Stats-->
                        <div class="fw-bolder text-gray-700 text-xxl-end">$2.00 / 10 Properties</div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Label-->
                </div>
                <!--end::Labels-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 17-->
    </div>
    <!--end::Col-->
</div>
@endsection

@push('js')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('keen') }}/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{ asset('keen') }}/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('keen') }}/js/widgets.bundle.js"></script>
<script src="{{ asset('keen') }}/js/custom/apps/chat/chat.js"></script>
<script src="{{ asset('keen') }}/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="{{ asset('keen') }}/js/custom/utilities/modals/create-campaign.js"></script>
<script src="{{ asset('keen') }}/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
@endpush
