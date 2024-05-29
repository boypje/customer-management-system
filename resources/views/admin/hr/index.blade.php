@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">

    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        {{--  <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Data Karyawan Aktif</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Data Karyawan Tidak Aktif</a>
            </li>
        </ul>  --}}
        @include('admin.hr.buttonUsers')
        @include('admin.hr.modalEditUser')
	    @include('admin.hr.formUploadUsers')

        <div class="card-body">
          <div class="tab-content mt-3">
            <div class="text-center">
                <h2>{{ __('Data Karyawan') }}</h2>
            </div>
            <div class="table-responsive">
                <input type="hidden" id="statusUserTable" name="deActiveUser" value="1">
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
<!-- core user js and form -->
@include('admin.hr.js')
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
