
@section('nav_tab_user_tidak_aktif')
<li class="nav-item">
  <a class="nav-link" href="#penomoran-tab" role="tab" aria-controls="penomoran-tab" aria-selected="true">Daftar SPT Pengawasan</a>
</li>
@endsection

<style>
    .alert {
        font-size: .875rem;
        width: 500px;
        margin: 25px auto;
    }
</style>
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">
    <div class="row">
        <div class="col">

            <div class="card shadow" id="user-card">
                <div class="card-body">
                    <div class="text-center">
                        <h2>{{ __('Data Karyawan Yang Tidak Aktif') }}</h2>
                    </div>
                    <div class="table-responsive">
                        <input type="hidden" id="statusUserTable" name="deActiveUser" value="0">
                        <table class="table table-striped table-sm ajax-table" id="users-table">
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
@include('admin.hr.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush
