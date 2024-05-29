@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow" id="user-card">
                <div class="card-body">
                    <div class="col-md-12 user-form">
                        <div class="invalid-feedback" permission="alert">

                        </div>
                        <div class="row" id="rows" style="display: none;">
                            <div class="col">
                              <p class="alert alert-success" id="msg"></p>
                            </div>
                          </div>
                        <form id="bucketKlien-form" class="ajax-form" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">

                            @csrf
                                <h3 class="zheading-small text-muted mb-5">{{ __('Input Bucket Klien') }}</h3>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Nama Bucket') }}</span>
                                <div class="col-md-3">
                                    <input id="nama_bucket" type="text" class="form-control @error('ktp') is-invalid @enderror" name="nama_bucket" value="" required autofocus placeholder="{{ __('Contoh : S1 / M1') }}">

                                    @error('nama_platform')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('DPD') }}</span>
                                <div class="col-md-3">
                                    <input id="dpd" type="text" class="form-control @error('ktp') is-invalid @enderror" name="dpd" value="" required autofocus placeholder="{{ __('Contoh : 10 - 20') }}">
                                    <small class="text-muted">Input kan range DPD yang diinginkan</small>
                                    @error('nama_platform')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> <br>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary offset-md-3 default-button">
                                        {{ __('Submit') }}
                                    </button>
                                    <button type="button" class="btn btn-danger offset-md-1" onclick="window.location='{{ route('platform') }}'">
                                        {{ __('Kembali') }}
                                    </button>
                                </div>
                            </div>
                        </form>

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
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush
