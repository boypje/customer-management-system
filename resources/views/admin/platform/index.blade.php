@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">

    <div class="col-md-12 dashboard-bg-color">
        <div class="card">
            @include('admin.platform.buttonPlatform')
            <div class="row">
                <div class="col-md-6">
                    <div class="tab-content mt-3">
                        <div class="text-center">
                            <h2>{{ __('Data Klien') }}</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm ajax-table" id="platform-table" style="width:99%">
                                <thead>

                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="border-left: groove !important;">
                    <div class="tab-content mt-3">
                        <div class="text-center">
                            <h2>{{ __('Data Sub klien') }}</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm ajax-table" id="sub-client-tables" style="width:99%">
                                <thead>

                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- core user js and form -->
@include('admin.platform.js')
<!-- end core user -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush
