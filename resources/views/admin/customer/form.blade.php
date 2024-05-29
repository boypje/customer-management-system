<style>

</style>
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow" id="user-card">
                <div class="card-body">
                    <div class="col-md-12 user-form">
                        {{-- show message --}}
                        <div id="success-alert" class="alert alert-success" role="alert" style="display: none">
                            <strong>Data Berhasil</strong> disimpan ke Database.
                        </div>
                        <div id="fail-alert" class="alert alert-danger" role="alert" style="display: none">
                            <strong>Data Gagal</strong> disimpan ke Database.
                        </div>
                        {{-- end show message --}}
                        
                        <form id="customer-form" class="ajax-form" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">

                            @csrf

                            <h3 class="zheading-small text-muted mb-5">{{ __('Input Data Customer') }}</h3>
                            <div class="form-group row">
                                <span class="col-md-1 col-form-label labelclass">{{ __('ID Customer') }}</span>
                                <div class="col-md-3">
                                    <input id="id_customer" type="text" class="form-control @error('id_customer') is-invalid @enderror" name="id_customer" value="" placeholder="{{ __('ID Customer') }}">

                                    @error('id_customer')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Nama Customer') }}</span>
                                <div class="col-md-3">
                                    <input id="nama_customer" type="text" class="form-control @error('nama_customer') is-invalid @enderror" name="nama_customer" value="" required autofocus placeholder="{{ __('Nama Lengkap') }}">

                                    @error('nama_customer')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label">{{ __('KTP') }}</span>
                                <div class="col-md-3">
                                    <input id="ktp" type="text" class="form-control @error('ktp') is-invalid @enderror" name="ktp" value="" required autofocus placeholder="{{ __('No KTP') }}">
                                    @error('ktp')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <span class="col-md-1 col-form-label">{{ __('Email') }}</span>
                                <div class="col-md-3">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autofocus placeholder="{{ __('Email') }}">

                                    @error('email')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Phone 1') }}</span>
                                <div class="col-md-3">
                                    <input id="nomor_kontak" type="text" class="form-control @error('nomor_kontak') is-invalid @enderror" name="nomor_kontak" required autofocus placeholder="{{ __('Nomor Kontak') }}">

                                    @error('nomor_kontak')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label labelclass">{{ __('Phone 2') }}</span>
                                <div class="col-md-3">
                                    <input id="nomor_kontak2" type="text" class="form-control @error('nomor_kontak2') is-invalid @enderror" name="nomor_kontak2" required autofocus placeholder="{{ __('Nomor Kontak 2') }}">

                                    @error('nomor_kontak2')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <span class="col-md-1 col-form-label labelclass">{{ __('Facebook') }}</span>
                                <div class="col-md-3">
                                    <input id="sosmed1" type="text" class="form-control @error('sosmed1') is-invalid @enderror" name="fb" value="" autofocus placeholder="{{ __('facebook') }}">

                                    @error('sosmed1')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 text-md-right col-form-label">{{ __('Twitter') }}</span>
                                <div class="col-md-3">
                                    <input id="sosmed2" type="text" class="form-control @error('sosmed2') is-invalid @enderror" name="twitter" value="" autofocus placeholder="{{ __('twitter') }}">
                                    @error('sosmed2')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label">{{ __('Instagram') }}</span>
                                <div class="col-md-3">
                                    <input id="sosmed3" type="text" class="form-control @error('sosmed3') is-invalid @enderror" name="ig" value="" autofocus placeholder="{{ __('instagram') }}">
                                    @error('sosmed3')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <span class="col-md-1 col-form-label">{{ __('Platform') }}</span>
                                <div class="col-md-3">
                                    <select class="form-control selectize" id="platform" name="platform">
                                        <option value="" selected disabled>{{ __('Pilih Platform') }}</option>
                                        @foreach($platform as $platforms)
                                            <option class="form-control" value="{{$platforms->id}}" >{{ $platforms->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="col-md-1 col-form-label text-md-right labelclass">{{ __('Alamat') }}</span>
                                <div class="col-md-3">
                                    <textarea id="alamat" style="height: 100px;" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="" required autofocus placeholder="{{ __('Contoh : Jl. Menganti Surabaya') }}"></textarea>

                                    @error('alamat')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label " >{{ __('Tagihan') }}</span>
                                <div class="col-md-3">
                                    <input id="nominal" type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="" required autofocus placeholder="{{ __('Nominal') }}">
                                    @error('nominal')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <script>
                                    $("#platform").selectize({
                                        allowEmptyOption: true,
                                        placeholder: "Pilih Platform",
                                        create: false,
                                    });
                                </script>
                                
                            </div>
                            <div class="form-group row">
                                <span class="col-md-1 col-form-label">{{ __('Jenis Kontak') }}</span>
                                <div class="col-md-3">
                                        {{-- <div class="form-check form-check-inline">
                                        <input class="form-check-input messageCheckbox" type="radio" id="inlineRadio1" name="jenisKontak" value="sendiri">
                                        <label class="form-check-label" for="inlineRadio1">Sendiri</label>
                                        </div> --}}
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input messageCheckbox" type="radio" id="inlineRadio2" name="jenisKontak" value="ec">
                                        <label class="form-check-label" for="inlineRadio1">Kontak Darurat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input messageCheckbox" type="radio" id="inlineRadio3" name="jenisKontak" value="kantor">
                                        <label class="form-check-label" for="inlineRadio1">Kontak Kantor</label>
                                        </div>
                                </div>
                            </div>

                            <div class="form-group row" id="alamatKontak" style="display: none">
                                <span class="col-md-1 col-form-label" >{{ __('Nomor Kontak') }}</span>
                                <div class="col-md-3" id="" >
                                    <input id="nomor_kontak" type="text" class="form-control @error('nomor_kontak') is-invalid @enderror" name="nomor_kontak" value="" required autofocus placeholder="{{ __('Contoh : 0812xxxx') }}">

                                    @error('nomor_kontak')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="col-md-1 col-form-label" >{{ __('Hubungan Kontak') }}</span>
                                <div class="col-md-3" id="" >
                                    <input id="tags" type="text" class="form-control @error('hubungan_kontak') is-invalid @enderror" name="hubungan_kontak" value="" required autofocus placeholder="{{ __('Contoh : Kerabat, Saudara, Teman') }}">

                                    @error('hubungan_kontak')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <script>
                                        $(function() {
                                            var availableTags = [
                                                "Teman",
                                                "Saudara",
                                                "Kenalan",
                                                "Tetangga",
                                                "Orang Tua"
                                            ];
                                            $("#tags").autocomplete({
                                                source: availableTags
                                            });
                                        });
                                     </script>
                                </div>
                                <span class="col-md-1 col-form-label text-md-right labelclass alamatKontakLabel">{{ __('Alamat Kontak') }}</span>
                                <div class="col-md-3" >
                                    <textarea id="alamat_kontak" style="height: 100px;" type="text" class="form-control @error('alamat_kontak') is-invalid @enderror" name="alamat_kontak" value="" required autofocus placeholder="{{ __('Contoh : Jl. Menganti Surabaya') }}"></textarea>

                                    @error('alamat_kontak')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row" id="namaKontak" style="display: none">
                                <span class="col-md-1 col-form-label" >{{ __('Nama Kontak') }}</span>
                                <div class="col-md-3">
                                    <input id="nama_kontak" type="text" class="form-control @error('nama_kontak') is-invalid @enderror" name="nama_kontak" value="" required autofocus placeholder="{{ __('Nama Kontak') }}">
                                    @error('nama_kontak')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button id="submitData" type="submit" class="btn btn-primary offset-md-3 default-button">
                                        {{ __('Submit') }}
                                    </button>
                                    <button type="button" class="btn btn-danger offset-md-1" onclick="window.location='{{ route('customer') }}'">
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
@include('admin.customer.js')
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
