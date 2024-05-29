@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card">
                    <ul class="nav nav-tabs" style="border-bottom: 0; margin: 10px;" role="tablist">
                        <a href="#" id="showFormSettingTeam" class="btn btn-outline-success btn-sm">Seting Team</a>
                        <a href="#" id="hideFormSettingTeam" class="btn btn-outline-danger btn-sm" style="display: none;">Back</a>
                    </ul>
                    @include('admin.platform.formPembagianAgent')
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 30px;">
                            <div class="tab-content mt-3">
                                <div class="text-center">
                                    <h2>{{ __('Data Tim') }}</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm ajax-table" id="manageAgen-table" style="width:99%">
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
    </div>
</div>
@include('admin.platform.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />

@endpush
@push('js')
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush
