@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">

    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-body">
          <div class="tab-content mt-3">
            <div class="text-center">
                <h2>{{ __('Record Calling Agent') }}</h2>
            </div>
                @include('admin.calling.tb_calling')
          </div>
        </div>
    </div>
  </div>
</div>
<!-- core user js and form -->
@include('admin.calling.js')
<!-- end core user -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/datatables/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
