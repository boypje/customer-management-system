@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">

    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        @hasanyrole('Super Admin|Admin|Collection Manager')
        <nav class="navbar navbar-expand-md">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" style="margin-right: 10px;">
                        <a href="{{ route('formCustomer') }}" class="btn btn-outline-success btn-sm">Tambah Data Customer</a>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-outline-primary btn-sm"  id="buttonShowImportFormCustomer">{{ __('Upload Data Customer') }}</button>
                        <button type="button" class="btn btn-outline-danger btn-sm" style="display: none;" id="buttonHideImportFormCustomer">{{ __('Tutup Upload Data Customer') }}</button>
                    </li>
                </ul>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{route('getTamplateCustomer')}}" class="btn btn-outline-primary btn-sm right" style="float: right !important;">Download Format Data Customer</a>
                    </li>
                </ul>
            </div>
        </nav>
        @endhasanyrole
        
        @include('admin.customer.importFormCustomer')
        
        @include('admin.customer.modalUpdateCustomer')

        <div class="card-body">
          <div class="tab-content mt-3">
            
            <div class="text-center">
                <h2>{{ __('Data Customer') }}</h2>
            </div>
            <br>
                @if(Auth::user()->hasRole('admin'))
                @include('admin.customer.tb_admin')
                @else
                @include('admin.customer.tb_customer')
                @endif
          </div>
        </div>
    </div>
  </div>

</div>
<!-- core user js and form -->
@include('admin.customer.js')
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
