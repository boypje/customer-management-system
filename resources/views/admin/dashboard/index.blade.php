{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    <div class="col-md-12 dashboard-bg-color">
    {{--  success change pwd  --}}
    @if(session()->has('SuccessChangePwd'))
        <div class="alert alert-success">
            {{ session()->get('SuccessChangePwd') }}
        </div>
        <script>
            setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 4500); // <-- time in milliseconds
        </script>
    @endif
    @include('admin.dashboard.content-dashboard')
  </div>

</div>

<!-- end core spt -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
