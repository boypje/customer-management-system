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
                        <form id="user-form" class="ajax-form" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">

                            @csrf
                                <h3 class="zheading-small text-muted mb-5">{{ __('Input Karyawan') }}</h3>
                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>
                                    <div class="col-md-7">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required placeholder="{{ __('Nama Lengkap') }}">

                                        @error('name')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <input id="idSSS" type="text" class="form-control @error('idSSS') is-invalid @enderror" name="idSSS" required placeholder="{{ __('ID Karyawan') }}">

                                        @error('idSSS')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Nomor') }}</span>
                                    <div class="col-md-5">
                                        <input id="ktp" type="text" class="form-control @error('ktp') is-invalid @enderror" name="ktp" required autofocus placeholder="{{ __('KTP') }}">

                                        @error('ktp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="kk" type="text" class="form-control @error('kk') is-invalid @enderror" name="kk" autofocus placeholder="{{ __('KK') }}">

                                        @error('kk')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('') }}</span>
                                    <div class="col-md-5">
                                        <input id="passport" type="text" class="form-control @error('passport') is-invalid @enderror" name="passport" autofocus placeholder="{{ __('Passport') }}">

                                        @error('passport')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="nwpwp" type="text" class="form-control @error('nwpwp') is-invalid @enderror" name="nwpwp" autofocus placeholder="{{ __('NPWP') }}">

                                        @error('nwpwp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">Alamat KTP</span>
                                    <div class="col-md-5">
                                        <input id="alamat_ktp" type="text" class="form-control @error('alamat_ktp') is-invalid @enderror" name="alamat_ktp" placeholder="Alamat Sesuai KTP" required>

                                        @error('alamat_ktp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="alamat_domisili" type="text" class="form-control @error('alamat_domisili') is-invalid @enderror" name="alamat_domisili" placeholder="Alamat Sesuai Domisili" required>

                                        @error('alamat_domisili')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">RT/RW KTP</span>
                                    <div class="col-md-5">
                                        <input id="rt_rw_ktp" type="text" class="form-control @error('rt_rw_ktp') is-invalid @enderror" name="rt_rw_ktp"  placeholder="RT/RW KTP" required>

                                        @error('rt_rw_ktp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="rt_rw_domisili" type="text" class="form-control @error('rt_rw_domisili') is-invalid @enderror" name="rt_rw_domisili"  placeholder="RT/RW Domisili" required>

                                        @error('rt_rw_domisili')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">Kelurahan KTP</span>
                                    <div class="col-md-5">
                                        <input id="kelurahan_ktp" type="text" class="form-control @error('kelurahan_ktp') is-invalid @enderror" name="kelurahan_ktp"  placeholder="Kelurahan KTP" required>

                                        @error('kelurahan_ktp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="kelurahan_domisili" type="text" class="form-control @error('kelurahan_domisili') is-invalid @enderror" name="kelurahan_domisili"  placeholder="Kelurahan Domisili" required>

                                        @error('kelurahan_domisili')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">Kecamatan KTP</span>
                                    <div class="col-md-5">
                                        <input id="kecamatan_ktp" type="text" class="form-control @error('kecamatan_ktp') is-invalid @enderror" name="kecamatan_ktp"  placeholder="Kecamatan KTP" required>

                                        @error('kecamatan_ktp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="kecamatan_domisili" type="text" class="form-control @error('kecamatan_domisili') is-invalid @enderror" name="kecamatan_domisili"  placeholder="Kecamatan Domisili" required>

                                        @error('kecamatan_domisili')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">Kota/Kab KTP</span>
                                    <div class="col-md-5">
                                        <input id="kota_kab_ktp" type="text" class="form-control @error('kota_kab_ktp') is-invalid @enderror" name="kota_kab_ktp"  placeholder="Kota/Kab KTP" required>

                                        @error('kota_kab_ktp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="kota_kab_domisili" type="text" class="form-control @error('kota_kab_domisili') is-invalid @enderror" name="kota_kab_domisili"  placeholder="Kota/Kab Domisili" required>

                                        @error('kota_kab_domisili')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">Kode Post KTP</span>
                                    <div class="col-md-5">
                                        <input id="kode_post_ktp" type="text" class="form-control @error('kode_post_ktp') is-invalid @enderror" name="kode_post_ktp"  placeholder="Kode Post KTP" required>

                                        @error('kode_post_ktp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="kode_post_domisili" type="text" class="form-control @error('kode_post_domisili') is-invalid @enderror" name="kode_post_domisili"  placeholder="Kode Post Domisili" required>

                                        @error('kode_post_domisili')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Kontak') }}</span>
                                    <div class="col-md-5">
                                        <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" required autofocus placeholder="{{ __('No. Hp') }}">

                                        @error('no_hp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="no_telp" type="text" class="form-control" name="no_telp" placeholder="{{ __('No. Telepon Rumah') }}">
                                        @error('no_telp')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('No. Kontak Darurat') }}</span>
                                    <div class="col-md-5">
                                        <input id="no_ec1" type="text" class="form-control @error('no_ec1') is-invalid @enderror" name="no_ec1" required placeholder="{{ __('Nomor Kontak Darurat 1') }}">

                                        @error('no_ec1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="no_ec2" type="text" class="form-control @error('no_ec2') is-invalid @enderror" name="no_ec2" required placeholder="{{ __('Nomor Kontak Darurat 2') }}">
                                        @error('no_ec2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Nama (Kontak Darurat)') }}</span>
                                    <div class="col-md-5">
                                        <input id="nama_ec1" type="text" class="form-control @error('nama_ec1') is-invalid @enderror" name="nama_ec1" required placeholder="{{ __('Nama Kontak Darurat 1') }}">

                                        @error('nama_ec1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="nama_ec2" type="text" class="form-control @error('nama_ec2') is-invalid @enderror" name="nama_ec2"  required placeholder="{{ __('Nama Kontak Darurat 2') }}">
                                        @error('nama_ec2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Hubungan (Kontak Darurat)') }}</span>
                                    <div class="col-md-5">
                                        <input id="hub_ec1" type="text" class="form-control @error('hub_ec1') is-invalid @enderror" name="hub_ec1" required placeholder="{{ __('Hubungan Kontak Darurat 1') }}">

                                        @error('hub_ec1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="hub_ec2" type="text" class="form-control @error('hub_ec2') is-invalid @enderror" name="hub_ec2" required placeholder="{{ __('Hubungan Kontak Darurat 2') }}">
                                        @error('hub_ec2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Email') }}</span>
                                    <div class="col-md-5">
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus placeholder="{{ __('Email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input id="nama_ibu" type="text" class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu" required autofocus placeholder="{{ __('Nama Ibu Kandung') }}">
                                        @error('nama_ibu')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Tempat Lahir') }}</span>
                                    <div class="col-md-5 container1">
                                        <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" required placeholder="{{ __('Tempat Lahir') }}">
                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5 container1">
                                        <input id="tanggal_lahir" type="text" class="form-control datepick" name="tanggal_lahir" id="tanggal_lahir" autocomplete="off" required placeholder="{{ __('Tanggal Lahir')}}" data-date-format="dd-mm-yyyy">

                                        <script>
                                            $('#tanggal_lahir').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                        @error('tanggal_lahir')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Jabatan') }}</span>
                                    <div class="col-md-2">
                                        <select class="form-control selectize" id="jabatan" name="jabatan">
                                            <option value="" selected disabled>{{ __('Pilih Jabatan') }}</option>
                                            @foreach($dataRole as $role)
                                                <option class="form-control" value="{{$role->id}}" >{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control selectize" id="agama" name="agama">
                                            <option value="" selected disabled>{{ __('Pilih Agama') }}</option>
                                            <option class="form-control" value="Islam">Islam</option>
                                            <option class="form-control" value="Buddha" >Buddha</option>
                                            <option class="form-control" value="Hindu" >hindu</option>
                                            <option class="form-control" value="Kristen Katolik">Kristen Katolik</option>
                                            <option class="form-control" value="Khonghucu" >Khonghucu</option>
                                            <option class="form-control" value="Kristen">Kristen</option>
                                            <option class="form-control" value="Kristen Protestan">Kristen Protestan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control selectize" id="status_pernikahan" name="status_pernikahan">
                                            <option value="" selected disabled>{{ __('Pilih Status Pernikahan') }}</option>
                                            <option class="form-control" value="TK" >Belum Kawin</option>
                                            <option class="form-control" value="K0" >Kawin belum punya anak</option>
                                            <option class="form-control" value="K1" >Kawin anak 1</option>
                                            <option class="form-control" value="K2" >Kawin anak 2</option>
                                            <option class="form-control" value="K3" >Kawin anak 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 container1">
                                        <input id="darah" type="text" class="form-control @error('darah') is-invalid @enderror" name="darah" required placeholder="{{ __('Golongan Darah') }}">
                                        @error('darah')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--  <script>

                                </script>  --}}
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Kewarganegaraan') }}</span>
                                    <div class="col-md-3 container1">
                                        <input id="kewarganegaraan" type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror" name="kewarganegaraan" required placeholder="{{ __('Kewarganegaraan') }}">
                                        @error('kewarganegaraan')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 container1">
                                        <input id="suku" type="text" class="form-control @error('suku') is-invalid @enderror" name="suku" required placeholder="{{ __('Suku Bangsa') }}">
                                        @error('suku')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <h6 class="heading-small text-muted mb-4">{{ __('Riwayat Pendidikan') }}</h6>

                                <div class="row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-2">Jenjang</div>
                                    {{--  <div class="col-md-1">Tahun Masuk</div>--}}
                                    <div class="col-md-3">Jurusan</div>
                                    <div class="col-md-5">Institusi / Sekolah</div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-2">
                                        <select class="form-control selectize" id="pendidikan_1" name="pendidikan_1" required>
                                            <option value="" selected disabled>{{ __('Pilih') }}</option>
                                            <option value='S2'>S2</option>
                                            <option value='S1'>S1</option>
                                            <option value='D4'>D4</option>
                                            <option value='D3'>D3</option>
                                            <option value='D2'>D2</option>
                                            <option value='D1'>D1</option>
                                            <option value='SMA'>SMA/SMK</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 container1">
                                        <input id="jurusan1" type="text" class="form-control @error('jurusan1') is-invalid @enderror" name="jurusan1" required placeholder="{{ __('Jurusan') }}">
                                        @error('jurusan1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5 container1">
                                        <input id="sekolah1" type="text" class="form-control @error('sekolah1') is-invalid @enderror" name="sekolah1" required placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                        @error('sekolah1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <script>
                                        $("#pendidikan_1").selectize({
                                            allowEmptyOption: true,
                                            placeholder: "Jenjang",
                                            create: false,
                                        });
                                    </script>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-2">
                                        <select class="form-control selectize" id="pendidikan_2" name="pendidikan_2">
                                            <option value="" selected disabled>{{ __('Pilih') }}</option>
                                            <option value='SMA'>SMA/SMK</option>
                                            <option value='SMP'>SMP</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 container1">
                                        <input id="jurusan2" type="text" class="form-control @error('jurusan2') is-invalid @enderror" name="jurusan2" placeholder="{{ __('Jurusan') }}">
                                        @error('jurusan2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5 container1">
                                        <input id="sekolah2" type="text" class="form-control @error('sekolah2') is-invalid @enderror" name="sekolah2" placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                        @error('sekolah2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <script>
                                        $("#pendidikan_2").selectize({
                                            allowEmptyOption: true,
                                            placeholder: "Pilih Jenjang 2",
                                            create: false,
                                        });

                                    </script>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-2">
                                        <select class="form-control selectize" id="pendidikan_3" name="pendidikan_3">
                                            <option value="" selected disabled>{{ __('Pilih') }}</option>
                                            <option value='SMP'>SMP</option>
                                            <option value='SD'>SD</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 container1">
                                        <input id="jurusan3" type="text" class="form-control @error('jurusan3') is-invalid @enderror" name="jurusan3" placeholder="{{ __('Jurusan') }}" disabled>
                                        @error('jurusan3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5 container1">
                                        <input id="sekolah3" type="text" class="form-control @error('sekolah3') is-invalid @enderror" name="sekolah3" placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                        @error('sekolah3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <script>
                                        $("#pendidikan_3").selectize({
                                            allowEmptyOption: true,
                                            placeholder: "Pilih Jenjang 2",
                                            create: false,
                                        });
                                    </script>
                                </div>

                                <h6 class="heading-small text-muted mb-4">{{ __('Pengalaman Kerja') }}</h6>

                                <div class="row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-2">Tahun Masuk</div>
                                    <div class="col-md-2">Tahun Keluar</div>
                                    <div class="col-md-2">Nama Instansi</div>
                                    <div class="col-md-2">Jabatan</div>
                                    <div class="col-md-2">Gaji Terakhir</div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass"></span>
                                    <div class="col-md-2 container1">
                                        <input id="tanggal_masukkerja1" type="text" class="form-control datepick" name="tanggal_masukkerja1" id="tanggal_masukkerja1" autocomplete="off" placeholder="{{ __('Tanggal Masuk')}}" data-date-format="dd-mm-yyyy">
                                        @error('tanggal_masukkerja1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tanggal_keluarkerja1" type="text" class="form-control datepick" name="tanggal_keluarkerja1" id="tanggal_keluarkerja1" autocomplete="off" placeholder="{{ __('Tanggal Keluar')}}" data-date-format="dd-mm-yyyy">
                                        @error('tanggal_keluarkerja1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="perusahaan1" type="text" class="form-control @error('perusahaan1') is-invalid @enderror" name="perusahaan1" placeholder="{{ __('Nama Perusahaan') }}">
                                        @error('perusahaan1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="jabatan1" type="text" class="form-control @error('jabatan1') is-invalid @enderror" name="jabatan1" placeholder="{{ __('Jabatan') }}">
                                        @error('jabatan1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="gaji_terakhir1" type="text" class="form-control @error('gaji_terakhir1') is-invalid @enderror" name="gaji_terakhir1" placeholder="{{ __('Gaji Terakhir') }}">
                                        @error('gaji_terakhir1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <script>
                                        $('#tanggal_masukkerja1').datepicker({
                                            format: "dd/mm/yyyy",
                                            autoclose: true,
                                        });
                                        $('#tanggal_keluarkerja1').datepicker({
                                            format: "dd/mm/yyyy",
                                            autoclose: true,
                                        });
                                        $('#gaji_terakhir1').keyup(function(event) {
                                            if (event.which >= 37 && event.which <= 40) return;
                                            $(this).val(function(index, value) {
                                                return value
                                                // Keep only digits and decimal points:
                                                .replace(/[^\d.]/g, "")
                                                // Remove duplicated decimal point, if one exists:
                                                .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                                                // Keep only two digits past the decimal point:
                                                .replace(/\.(\d{2})\d+/, '.$1')
                                                // Add thousands separators:
                                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                            });
                                        });
                                    </script>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass"></span>
                                    <div class="col-md-2 container1">
                                        <input id="tanggal_masukkerja2" type="text" class="form-control datepick" name="tanggal_masukkerja2" id="tanggal_masukkerja2" autocomplete="off" placeholder="{{ __('Tanggal Masuk')}}">
                                        @error('tanggal_masukkerja2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tanggal_keluarkerja2" type="text" class="form-control datepick" name="tanggal_keluarkerja2" id="tanggal_keluarkerja2" autocomplete="off" placeholder="{{ __('Tanggal Keluar')}}">
                                        @error('tanggal_keluarkerja2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="perusahaan2" type="text" class="form-control @error('perusahaan2') is-invalid @enderror" name="perusahaan2" placeholder="{{ __('Nama Perusahaan') }}">
                                        @error('perusahaan2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="jabatan2" type="text" class="form-control @error('jabatan2') is-invalid @enderror" name="jabatan2" placeholder="{{ __('Jabatan') }}">
                                        @error('jabatan2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="gaji_terakhir2" type="text" class="form-control @error('gaji_terakhir2') is-invalid @enderror" name="gaji_terakhir2" placeholder="{{ __('Gaji Terakhir') }}">
                                        @error('gaji_terakhir2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <script>
                                        $('#tanggal_masukkerja2').datepicker({
                                            format: "dd/mm/yyyy",
                                            autoclose: true,
                                        });
                                        $('#tanggal_keluarkerja2').datepicker({
                                            format: "dd/mm/yyyy",
                                            autoclose: true,
                                        });
                                        $('#gaji_terakhir2').keyup(function(event) {
                                            if (event.which >= 37 && event.which <= 40) return;
                                            $(this).val(function(index, value) {
                                                return value
                                                // Keep only digits and decimal points:
                                                .replace(/[^\d.]/g, "")
                                                // Remove duplicated decimal point, if one exists:
                                                .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                                                // Keep only two digits past the decimal point:
                                                .replace(/\.(\d{2})\d+/, '.$1')
                                                // Add thousands separators:
                                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                            });
                                        });

                                    </script>
                                </div>

                                <h6 class="heading-small text-muted mb-4">{{ __('Susunan Anggota Keluarga') }}</h6>

                                <div class="row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3">Nama</div>
                                     <div class="col-md-2">Tanggal Lahir</div>
                                    <div class="col-md-2">Pendidikan Terakhir</div>
                                    <div class="col-md-2">Pekerjaan</div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_ayah" type="text" class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah" placeholder="{{ __('Nama Ayah') }}">
                                        @error('nama_ayah')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_ayah" type="text" class="form-control @error('tgl_lahir_ayah') is-invalid @enderror" name="tgl_lahir_ayah" placeholder="{{ __('Tanggal Lahir Ayah') }}">
                                        @error('tgl_lahir_ayah')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_ayah').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_ayah" type="text" class="form-control @error('Pendidikan_terakhir_ayah') is-invalid @enderror" name="Pendidikan_terakhir_ayah" placeholder="{{ __('Pendidikan Terakhir Ayah') }}">
                                        @error('Pendidikan_terakhir_ayah')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_ayah" type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" name="pekerjaan_ayah" placeholder="{{ __('Pekerjaan Ayah') }}">
                                        @error('pekerjaan_ayah')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="sak_ibu" type="text" class="form-control @error('sak_ibu') is-invalid @enderror" name="sak_ibu" placeholder="{{ __('Nama Ibu') }}">
                                        @error('sak_ibu')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_ibu" type="text" class="form-control @error('tgl_lahir_ibu') is-invalid @enderror" name="tgl_lahir_ibu" placeholder="{{ __('Tanggal Lahir Ibu') }}">
                                        @error('tgl_lahir_ibu')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_ibu').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_ibu" type="text" class="form-control @error('Pendidikan_terakhir_ibu') is-invalid @enderror" name="Pendidikan_terakhir_ibu" placeholder="{{ __('Pendidikan Terakhir Ibu') }}">
                                        @error('Pendidikan_terakhir_ibu')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_ibu" type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" name="pekerjaan_ibu" placeholder="{{ __('Pekerjaan Ibu') }}">
                                        @error('pekerjaan_ibu')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_anak1" type="text" class="form-control @error('nama_anak1') is-invalid @enderror" name="nama_anak1" placeholder="{{ __('Nama Anak1') }}">
                                        @error('nama_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_anak1" type="text" class="form-control @error('tgl_lahir_anak1') is-invalid @enderror" name="tgl_lahir_anak1" placeholder="{{ __('Tanggal Lahir Anak1') }}">
                                        @error('tgl_lahir_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_anak1').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_anak1" type="text" class="form-control @error('Pendidikan_terakhir_anak1') is-invalid @enderror" name="Pendidikan_terakhir_anak1" placeholder="{{ __('Pendidikan Terakhir Anak1') }}">
                                        @error('Pendidikan_terakhir_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_anak1" type="text" class="form-control @error('pekerjaan_anak1') is-invalid @enderror" name="pekerjaan_anak1" placeholder="{{ __('Pekerjaan Anak1') }}">
                                        @error('pekerjaan_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_anak2" type="text" class="form-control @error('nama_anak2') is-invalid @enderror" name="nama_anak2" placeholder="{{ __('Nama Anak2') }}">
                                        @error('nama_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_anak2" type="text" class="form-control @error('tgl_lahir_anak2') is-invalid @enderror" name="tgl_lahir_anak2" placeholder="{{ __('Tanggal Lahir Anak2') }}">
                                        @error('tgl_lahir_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_anak2').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_anak2" type="text" class="form-control @error('Pendidikan_terakhir_anak2') is-invalid @enderror" name="Pendidikan_terakhir_anak2" placeholder="{{ __('Pendidikan Terakhir Anak2') }}">
                                        @error('Pendidikan_terakhir_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_anak2" type="text" class="form-control @error('pekerjaan_anak2') is-invalid @enderror" name="pekerjaan_anak2" placeholder="{{ __('Pekerjaan Anak2') }}">
                                        @error('pekerjaan_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_anak3" type="text" class="form-control @error('nama_anak3') is-invalid @enderror" name="nama_anak3" placeholder="{{ __('Nama Anak3') }}">
                                        @error('nama_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_anak3" type="text" class="form-control @error('tgl_lahir_anak3') is-invalid @enderror" name="tgl_lahir_anak3" placeholder="{{ __('Tanggal Lahir Anak3') }}">
                                        @error('tgl_lahir_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_anak3').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_anak3" type="text" class="form-control @error('Pendidikan_terakhir_anak3') is-invalid @enderror" name="Pendidikan_terakhir_anak3" placeholder="{{ __('Pendidikan Terakhir Anak3') }}">
                                        @error('Pendidikan_terakhir_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_anak3" type="text" class="form-control @error('pekerjaan_anak3') is-invalid @enderror" name="pekerjaan_anak3" placeholder="{{ __('Pekerjaan Anak3') }}">
                                        @error('pekerjaan_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_anak4" type="text" class="form-control @error('nama_anak4') is-invalid @enderror" name="nama_anak4" placeholder="{{ __('Nama Anak4') }}">
                                        @error('nama_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_anak4" type="text" class="form-control @error('tgl_lahir_anak4') is-invalid @enderror" name="tgl_lahir_anak4" placeholder="{{ __('Tanggal Lahir Anak4') }}">
                                        @error('tgl_lahir_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_anak4').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_anak4" type="text" class="form-control @error('Pendidikan_terakhir_anak4') is-invalid @enderror" name="Pendidikan_terakhir_anak4" placeholder="{{ __('Pendidikan Terakhir Anak4') }}">
                                        @error('Pendidikan_terakhir_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_anak4" type="text" class="form-control @error('pekerjaan_anak4') is-invalid @enderror" name="pekerjaan_anak4" placeholder="{{ __('Pekerjaan Anak4') }}">
                                        @error('pekerjaan_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_anak5" type="text" class="form-control @error('nama_anak5') is-invalid @enderror" name="nama_anak5" placeholder="{{ __('Nama Anak5') }}">
                                        @error('nama_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_anak5" type="text" class="form-control @error('tgl_lahir_anak5') is-invalid @enderror" name="tgl_lahir_anak5" placeholder="{{ __('Tanggal Lahir Anak5') }}">
                                        @error('tgl_lahir_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_anak5').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_anak5" type="text" class="form-control @error('Pendidikan_terakhir_anak5') is-invalid @enderror" name="Pendidikan_terakhir_anak5" placeholder="{{ __('Pendidikan Terakhir Anak5') }}">
                                        @error('Pendidikan_terakhir_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_anak5" type="text" class="form-control @error('pekerjaan_anak5') is-invalid @enderror" name="pekerjaan_anak5" placeholder="{{ __('Pekerjaan Anak5') }}">
                                        @error('pekerjaan_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <h6 class="heading-small text-muted mb-4">{{ __('Susunan Keluarga Anda') }}</h6>

                                <div class="row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3">Nama</div>
                                     <div class="col-md-2">Tanggal Lahir</div>
                                    <div class="col-md-2">Pendidikan Terakhir</div>
                                    <div class="col-md-2">Pekerjaan</div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_suami_istri" type="text" class="form-control @error('nama_suami_istri') is-invalid @enderror" name="nama_suami_istri" placeholder="{{ __('Nama Suami / Istri') }}">
                                        @error('nama_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_suami_istri" type="text" class="form-control @error('tgl_lahir_suami_istri') is-invalid @enderror" name="tgl_lahir_suami_istri" placeholder="{{ __('Tanggal Lahir Suami / Istri') }}">
                                        @error('tgl_lahir_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_suami_istri').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_suami_istri" type="text" class="form-control @error('Pendidikan_terakhir_suami_istri') is-invalid @enderror" name="Pendidikan_terakhir_suami_istri" placeholder="{{ __('Pendidikan Terakhir Suami / Istri') }}">
                                        @error('Pendidikan_terakhir_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_suami_istri" type="text" class="form-control @error('pekerjaan_suami_istri') is-invalid @enderror" name="pekerjaan_suami_istri" placeholder="{{ __('Pekerjaan Suami / Istri') }}">
                                        @error('pekerjaan_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_suami_istri" type="text" class="form-control @error('nama_suami_istri') is-invalid @enderror" name="nama_suami_istri" placeholder="{{ __('Nama Suami / Istri') }}">
                                        @error('nama_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_suami_istri" type="text" class="form-control @error('tgl_lahir_suami_istri') is-invalid @enderror" name="tgl_lahir_suami_istri" placeholder="{{ __('Tanggal Lahir Suami / Istri') }}">
                                        @error('tgl_lahir_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_suami_istri').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_suami_istri" type="text" class="form-control @error('Pendidikan_terakhir_suami_istri') is-invalid @enderror" name="Pendidikan_terakhir_suami_istri" placeholder="{{ __('Pendidikan Terakhir Suami / Istri') }}">
                                        @error('Pendidikan_terakhir_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_suami_istri" type="text" class="form-control @error('pekerjaan_suami_istri') is-invalid @enderror" name="pekerjaan_suami_istri" placeholder="{{ __('Pekerjaan Suami / Istri') }}">
                                        @error('pekerjaan_suami_istri')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_ska_anak1" type="text" class="form-control @error('nama_ska_anak1') is-invalid @enderror" name="nama_ska_anak1" placeholder="{{ __('Nama Anak1') }}">
                                        @error('nama_ska_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_ska_anak1" type="text" class="form-control @error('tgl_lahir_ska_anak1') is-invalid @enderror" name="tgl_lahir_ska_anak1" placeholder="{{ __('Tanggal Lahir anak1') }}">
                                        @error('tgl_lahir_ska_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_ska_anak1').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_ska_anak1" type="text" class="form-control @error('Pendidikan_terakhir_ska_anak1') is-invalid @enderror" name="Pendidikan_terakhir_ska_anak1" placeholder="{{ __('Pendidikan Terakhir Anak2') }}">
                                        @error('Pendidikan_terakhir_ska_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_ska_anak1" type="text" class="form-control @error('pekerjaan_ska_anak1') is-invalid @enderror" name="pekerjaan_ska_anak1" placeholder="{{ __('Pekerjaan Anak1') }}">
                                        @error('pekerjaan_ska_anak1')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_ska_anak2" type="text" class="form-control @error('nama_ska_anak2') is-invalid @enderror" name="nama_ska_anak2" placeholder="{{ __('Nama Anak2') }}">
                                        @error('nama_ska_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_ska_anak2" type="text" class="form-control @error('tgl_lahir_ska_anak2') is-invalid @enderror" name="tgl_lahir_ska_anak2" placeholder="{{ __('Tanggal Lahir Anak2') }}">
                                        @error('tgl_lahir_ska_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_ska_anak2').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_ska_anak2" type="text" class="form-control @error('Pendidikan_terakhir_ska_anak2') is-invalid @enderror" name="Pendidikan_terakhir_ska_anak2" placeholder="{{ __('Pendidikan Terakhir Anak2') }}">
                                        @error('Pendidikan_terakhir_ska_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_ska_anak2" type="text" class="form-control @error('pekerjaan_ska_anak2') is-invalid @enderror" name="pekerjaan_ska_anak2" placeholder="{{ __('Pekerjaan Anak2') }}">
                                        @error('pekerjaan_ska_anak2')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_ska_anak3" type="text" class="form-control @error('nama_ska_anak3') is-invalid @enderror" name="nama_ska_anak3" placeholder="{{ __('Nama Anak3') }}">
                                        @error('nama_ska_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_ska_anak3" type="text" class="form-control @error('tgl_lahir_ska_anak3') is-invalid @enderror" name="tgl_lahir_ska_anak3" placeholder="{{ __('Tanggal Lahir Anak3') }}">
                                        @error('tgl_lahir_ska_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_ska_anak3').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_ska_anak3" type="text" class="form-control @error('Pendidikan_terakhir_ska_anak3') is-invalid @enderror" name="Pendidikan_terakhir_ska_anak3" placeholder="{{ __('Pendidikan Terakhir Anak3') }}">
                                        @error('Pendidikan_terakhir_ska_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_ska_anak3" type="text" class="form-control @error('pekerjaan_ska_anak3') is-invalid @enderror" name="pekerjaan_ska_anak3" placeholder="{{ __('Pekerjaan Anak3') }}">
                                        @error('pekerjaan_ska_anak3')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_ska_anak4" type="text" class="form-control @error('nama_ska_anak4') is-invalid @enderror" name="nama_ska_anak4" placeholder="{{ __('Nama Anak4') }}">
                                        @error('nama_ska_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_ska_anak4" type="text" class="form-control @error('tgl_lahir_ska_anak4') is-invalid @enderror" name="tgl_lahir_ska_anak4" placeholder="{{ __('Tanggal Lahir Anak4') }}">
                                        @error('tgl_lahir_ska_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_ska_anak4').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_ska_anak4" type="text" class="form-control @error('Pendidikan_terakhir_ska_anak4') is-invalid @enderror" name="Pendidikan_terakhir_ska_anak4" placeholder="{{ __('Pendidikan Terakhir Anak4') }}">
                                        @error('Pendidikan_terakhir_ska_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_ska_anak4" type="text" class="form-control @error('pekerjaan_ska_anak4') is-invalid @enderror" name="pekerjaan_ska_anak4" placeholder="{{ __('Pekerjaan Anak4') }}">
                                        @error('pekerjaan_ska_anak4')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-3 container1">
                                        <input id="nama_ska_anak5" type="text" class="form-control @error('nama_ska_anak5') is-invalid @enderror" name="nama_ska_anak5" placeholder="{{ __('Nama Anak5') }}">
                                        @error('nama_ska_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="tgl_lahir_ska_anak5" type="text" class="form-control @error('tgl_lahir_ska_anak5') is-invalid @enderror" name="tgl_lahir_ska_anak5" placeholder="{{ __('Tanggal Lahir Anak5') }}">
                                        @error('tgl_lahir_ska_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <script>
                                            $('#tgl_lahir_ska_anak5').datepicker({
                                                format: "dd/mm/yyyy",
                                                autoclose: true,
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="Pendidikan_terakhir_ska_anak5" type="text" class="form-control @error('Pendidikan_terakhir_ska_anak5') is-invalid @enderror" name="Pendidikan_terakhir_ska_anak5" placeholder="{{ __('Pendidikan Terakhir Anak5') }}">
                                        @error('Pendidikan_terakhir_ska_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 container1">
                                        <input id="pekerjaan_ska_anak5" type="text" class="form-control @error('pekerjaan_ska_anak5') is-invalid @enderror" name="pekerjaan_ska_anak5" placeholder="{{ __('Pekerjaan Anak5') }}">
                                        @error('pekerjaan_ska_anak5')
                                            <span class="invalid-feedback" permission="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <h6 class="heading-small text-muted mb-4">{{ __('Upload') }}</h6> --}}

                                {{-- <div class="form-group row">
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('CV') }}</span>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="file_cv" id="file_cv" accept="application/pdf" required>
                                        <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file 500KB dengan format (pdf)
                                    </div><br>
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Foto Diri') }}</span>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="file_foto" id="file_foto" accept="image/png, image/jpg, image/jpeg" required>
                                        <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file 200KB dengan format (png, jgp, jpeg)

                                    </div>
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('KTP') }}</span>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="file_ktp" id="file_ktp" accept="image/png, image/jpg, image/jpeg" required>
                                        <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file 200KB dengan format (png, jgp, jpeg)

                                    </div>
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('KK') }}</span>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="file_kk" id="file_kk" accept="image/png, image/jpg, image/jpeg" required>
                                        <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file 200KB dengan format (png, jgp, jpeg)

                                    </div>
                                    <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Ijazah Terakhir') }}</span>
                                    <div class="col-md-4">
                                        <input type="file" class="form-control" name="file_ijazah" id="file_ijazah" accept="image/png, image/jpg, image/jpeg" required>
                                        <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file 200KB dengan format (png, jgp, jpeg)

                                    </div>
                                </div> --}}

                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary offset-md-3 default-button">
                                        {{ __('Submit') }}
                                    </button>
                                    <button type="button" class="btn btn-danger offset-md-1" onclick="window.location='{{ route('hr') }}'">
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
@include('admin.hr.js')
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
