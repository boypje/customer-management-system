@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">

    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-body">
          <div class="tab-content mt-3">
            <div class="text-center">
                <h2>{{ __('Record User') }}</h2>
            </div>
            <!-- <div class="table-responsive">
                <table class="table table-striped table-sm ajax-table" id="monitoring-table">
                    <thead>

                    </thead>
                    <tbody></tbody>
                </table>
            </div> -->
            @if(auth()->user()->hasRole('Super Admin'))
                @include('admin.monitoring.tb_monitoring')
            @endif
          </div>
        </div>
    </div>
  </div>
  @include('admin.monitoring.lihatUserCustomer')
</div>
<!-- core user js and form -->
@include('admin.monitoring.js')
<!-- end core user -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
