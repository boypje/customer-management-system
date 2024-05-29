@extends('layouts.backend')
<style>
.card{
    -webkit-touch-callout: none;
    -webkit-user-select: none;
     -khtml-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
}

</style>

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;" oncontextmenu="return false;">

    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-body">
            <h3 class="zheading-small text-muted mb-5">{{ __('Edit Data Customer') }}</h3>
            <form id="update-data-customer" action="" method="post">

            </form>
            <script>
                var id = {{ $id }};
                url = "{{ url('admin/customer/edit-data-customer') }}"+ '/' + id;
                //console.log(url);
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                        console.log(data)
                    },
                    error: function($data){
                    }
                });
            </script>
        </div>
    </div>
  </div>

</div>
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
