@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">

@if(session()->has('SuccessVerifDatabyAdmin'))
</center><div class="alert alert-success center" style="width: 50%;">
    <center>{{ session()->get('SuccessVerifDatabyAdmin') }}</center>
</div>
<script>
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 4500); // <-- time in milliseconds
</script>
@endif
    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-body">
          <div class="tab-content mt-3">
            <div class="text-center">
                <h2>{{ __('Report Payment') }}</h2>
            </div>
            @include('admin.payment.tb_report_payment')
          </div>
        </div>
    </div>
  </div>
</div>
<!-- core user js and form -->
@include('admin.payment.js')
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
