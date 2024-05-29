{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">

    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-header">
            <h2>Data Karyawan</h2>
        </div>
        <div class="card-body">
          <div class="tab-content mt-3">
         {{--  view data karyawan  --}}
        <div class="container">
            <div class="form-group row">
                <div class="col-md-3">
                    <table border="1">
                        <tr>
                            <td><img src="{{ asset("file_upload/$user->employee_id/$user->f_diri") }}" alt="" style="width: 210px;height: 270px;"></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-8">
                    <table class="table1 mqtable4" border="0" style="width: 100%;height: 70%;line-height: 40px;">
                        <tbody>
                            <tr>
                            <th colspan="6"><center>DATA INDUK KARYAWAN</center></th></tr>
                            <tr>
                                <td>NIK</td>
                                <td>: {{ ($user->ktp == null) ? '-' : $user->ktp }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Tgl. Masuk</td>
                                <td>: {{ ($user->join_date == null) ? '-' : $user->join_date }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>: {{ ($user->jabatan == null) ? '-' : $user->jabatan }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Kantor</td>
                                <td>: {{ ($user->user_status  == 'aktif') ? 'PT Sahabat Sakinah Senter' : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Divisi</td>
                                <td>: {{ ($user->jabatan == 'Desk Collection' || $user->jabatan == 'Leader DC' ? 'Collection' : $user->divisi) }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Status</td>
                                <td>: {{ ($user->status_pernikahan == null) ? '-' : $user->status_pernikahan }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <table class="table1 mqtable4" border="0" style="width: 100%;height:70%;line-height: 40px;">
                        <tbody>
                            <tr>
                            <th colspan="6"><center>IDENTITAS DIRI</center></th></tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>: {{ ($user->fullname == null) ? '-' : $user->fullname }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Agama</td>
                                <td>: {{ ($user->agama == null) ? '-' : $user->agama }}</td>
                            </tr>
                            <tr>
                                <td>No. KTP</td>
                                <td>: {{ ($user->ktp == null) ? '-' : $user->ktp }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Golongan Darah</td>
                                <td>: {{ ($user->golongan_darah  == null ) ? '-' : $user->golongan_darah }}</td>
                            </tr>
                            <tr>
                                <td>No. KK</td>
                                <td>: {{ ($user->kk == null) ? '-' : $user->kk }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Nama Ibu Kandung</td>
                                <td>: {{ ($user->n_ibu_kandung == null) ? '-' : $user->n_ibu_kandung }}</td>
                            </tr>
                            <tr>
                                <td>No. NPWP</td>
                                <td>: {{ ($user->npwp == null ) ? '-' : $user->npwp }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Tempat / TGL. Lahir</td>
                                <td>: {{ $user->tempat_lahir }} / {{ $user->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <td>Status Pernikahan</td>
                                <td>: {{ ($user->status_pernikahan == null) ? '-' : $user->status_pernikahan }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Kewarganegaraan</td>
                                <td>: {{ ($user->kewarganegaraan == null) ? '-' : $user->kewarganegaraan }}</td>
                            </tr>
                            <tr>
                                <td>Alamat <br>(Domisili)</td>
                                <td>: {{ ($user->almt_domisili == null) ? '-' : $user->almt_domisili }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Alamat <br>(Sesuai KTP)</td>
                                <td>: {{ ($user->almt_ktp == null) ? '-' :  $user->almt_ktp}}</td>

                            </tr>
                            <tr>
                                <td>No. Telp Rumah</td>
                                <td>: {{ ($user->tlp_rumah == null) ? '-' : $user->tlp_rumah }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Media Sosial</td>
                                <td>: {{ ($user->sosmed == null) ? '-' : $user->sosmed }}</td>
                            </tr>
                            <tr>
                                <td>No. HP / CDMA</td>
                                <td>: {{ ($user->tlp_hp == null) ? '-' :  $user->tlp_hp}}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Suku</td>
                                <td>: {{ ($user->suku == null) ? '-' :  $user->suku}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: {{ ($user->email == null) ? '-' : $user->email }}</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <table class="table1 mqtable4" border="0" style="width: 100%;height:70%;line-height: 40px;">
                        <tbody>
                            <tr>
                            <th colspan="6"><center>KELUARGA YANG DAPAT DIHUBUNGI DALAM KEADAAN DARURAT</center></th></tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ (json_decode($user->ec1) == null) ? '-' : json_decode($user->ec1)->nama_ec1 }}</td>
                                <td>Nama</td>
                                <td>: {{ (json_decode($user->ec2) == null) ? '-' : json_decode($user->ec2)->nama_ec2 }}</td>
                            </tr>
                            <tr>
                                <td>No. Telp / HP</td>
                                <td>: {{ (json_decode($user->ec1) == null) ? '-' : json_decode($user->ec1)->nomor_ec1 }}</td>
                                <td>No. Telp / HP</td>
                                <td>: {{ (json_decode($user->ec2) == null) ? '-' : json_decode($user->ec2)->nomor_ec2 }}</td>
                            </tr>
                            <tr>
                                <td>Hubungan</td>
                                <td>: {{ (json_decode($user->ec1) == null) ? '-' : json_decode($user->ec1)->hub_ec1 }}</td>
                                <td>Hubungan</td>
                                <td>: {{ (json_decode($user->ec2) == null) ?  '-' : json_decode($user->ec2)->hub_ec2 }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <table class="table1 mqtable4" border="0" style="width: 100%;height:70%;line-height: 40px;">
                        <tbody>
                            <tr>
                                <th colspan="6"><center>SUSUNAN ANGGOTA KELUARGA ( Ayah, Ibu, Saudara kandung, Termasuk Diri Anda )</center></th>
                            </tr>
                                <th>Anggota</th>
                                <th>Nama</th>
                                <th>TGL. Lahir</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                            </tr>
                            <tr>
                                <td>Ayah</td>
                                <td>{{ ($anggota['0'] == null) ? '-' : $anggota['0'] }}</td>
                                <td>{{ ($tgl_anggota['0'] == null) ? '-' : $tgl_anggota['0'] }}</td>
                                <td>{{ ($pendidikan_anggota['0'] == null) ? '-' : $pendidikan_anggota['0'] }}</td>
                                <td>{{ ($pekerjaan_anggota['0'] == null) ? '-' : $pekerjaan_anggota['0'] }}</td>
                            </tr>
                            <tr>
                                <td>Ibu</td>
                                <td>{{ ($anggota['1'] == null) ? '-' : $anggota['1'] }}</td>
                                <td>{{ ($tgl_anggota['1'] == null) ? '-' : $tgl_anggota['1'] }}</td>
                                <td>{{ ($pendidikan_anggota['1'] == null) ? '-' : $pendidikan_anggota['1'] }}</td>
                                <td>{{ ($pekerjaan_anggota['1'] == null) ? '-' : $pekerjaan_anggota['1'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 1</td>
                                <td>{{ ($anggota['2'] == null) ? '-' : $anggota['2'] }}</td>
                                <td>{{ ($tgl_anggota['2'] == null) ? '-' : $tgl_anggota['2'] }}</td>
                                <td>{{ ($pendidikan_anggota['2'] == null) ? '-' : $pendidikan_anggota['2'] }}</td>
                                <td>{{ ($pekerjaan_anggota['2'] == null) ? '-' : $pekerjaan_anggota['2'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 2</td>
                                <td>{{ ($anggota['3'] == null) ? '-' : $anggota['3'] }}</td>
                                <td>{{ ($tgl_anggota['3'] == null) ? '-' :  $tgl_anggota['3'] }}</td>
                                <td>{{ ($pendidikan_anggota['3'] == null) ? '-' : $pendidikan_anggota['3']}}</td>
                                <td>{{ ($pekerjaan_anggota['3'] == null) ? '-' : $pekerjaan_anggota['3'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 3</td>
                                <td>{{ ($anggota['4'] == null) ? '-' : $anggota['4'] }}</td>
                                <td>{{ ($tgl_anggota['4'] == null) ? '-' :  $tgl_anggota['4']}}</td>
                                <td>{{ ($pendidikan_anggota['4'] == null) ? '-' : $pendidikan_anggota['4']}}</td>
                                <td>{{ ($pekerjaan_anggota['4'] == null) ? '-' : $pekerjaan_anggota['4']}}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 4</td>
                                <td>{{ ($anggota['5'] == null) ? '-' : $anggota['5'] }}</td>
                                <td>{{ ($tgl_anggota['5'] == null) ? '-' : $tgl_anggota['5'] }}</td>
                                <td>{{ ($pendidikan_anggota['5'] == null) ? '-' : $pendidikan_anggota['5'] }}</td>
                                <td>{{ ($pekerjaan_anggota['5'] == null) ? '-' : $pekerjaan_anggota['5'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 5</td>
                                <td>{{ ($anggota['6'] == null) ? '-' : $anggota['6'] }}</td>
                                <td>{{ ($tgl_anggota['6'] == null ) ? '-' : $tgl_anggota['6'] }}</td>
                                <td>{{ ($pendidikan_anggota['6'] == null) ? '-' : $pendidikan_anggota['6'] }}</td>
                                <td>{{ ($pekerjaan_anggota['6'] == null) ? '-' : $pekerjaan_anggota['6'] }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <table class="table1 mqtable4" border="0" style="width: 100%;height:70%;line-height: 40px;">
                        <tbody>
                            <tr>
                                <th colspan="6"><center>SUSUNAN KELUARGA Anda ( Suami/Istri, Mertua, dan Anak Anda )</center></th>
                            </tr>
                                <th>Anggota</th>
                                <th>Nama</th>
                                <th>TGL. Lahir</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                            </tr>
                            <tr>
                                <td>Suami / Istri</td>
                                <td>{{ ($k_nama['0'] == null) ? '-' : $k_nama['0'] }}</td>
                                <td>{{ ($t_l_keluarga['0'] == null) ? '-' : $t_l_keluarga['0'] }}</td>
                                <td>{{ ($k_pddk['0'] == null) ? '-' : $k_pddk['0'] }}</td>
                                <td>{{ ($k_pkrjn['0'] == null) ? '-' : $k_pkrjn['0'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 1</td>
                                <td>{{ ($k_nama['1'] == null) ? '-' : $k_nama['1'] }}</td>
                                <td>{{ ($t_l_keluarga['1'] == null) ? '-' : $t_l_keluarga['1']}}</td>
                                <td>{{ ($k_pddk['1'] == null) ? '-' : $k_pddk['1'] }}</td>
                                <td>{{ ($k_pkrjn['1'] == null) ? '-' : $k_pkrjn['1'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 2</td>
                                <td>{{ ($k_nama['2'] == null) ? '-' : $k_nama['2'] }}</td>
                                <td>{{ ($t_l_keluarga['2'] == null) ? '-' : $t_l_keluarga['2'] }}</td>
                                <td>{{ ($k_pddk['2'] == null) ? '-' : $k_pddk['2'] }}</td>
                                <td>{{ ($k_pkrjn['2'] == null) ? '-' : $k_pkrjn['2'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 3</td>
                                <td>{{ ($k_nama['3'] == null) ? '-' : $k_nama['3'] }}</td>
                                <td>{{ ($t_l_keluarga['3'] == null) ? '-' : $t_l_keluarga['3'] }}</td>
                                <td>{{ ($k_pddk['3'] == null) ? '-' : $k_pddk['3'] }}</td>
                                <td>{{ ($k_pkrjn['3'] == null) ? '-' : $k_pkrjn['3'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 4</td>
                                <td>{{ ($k_nama['4'] == null ) ? '-' : $k_nama['4'] }}</td>
                                <td>{{ ($t_l_keluarga['4'] == null) ? '-' : $t_l_keluarga['4'] }}</td>
                                <td>{{ ($k_pddk['4'] == null) ? '-' :  $k_pddk['4']}}</td>
                                <td>{{ ($k_pkrjn['4'] == null) ? '-' : $k_pkrjn['4'] }}</td>
                            </tr>
                            <tr>
                                <td>Anak ke 5</td>
                                <td>{{ ($k_nama['5'] == null) ? '-' : $k_nama['5'] }}</td>
                                <td>{{ ($t_l_keluarga['5'] == null) ? '-' : $t_l_keluarga['5'] }}</td>
                                <td>{{ ($k_pddk['5'] == null) ? '-' : $k_pddk['5'] }}</td>
                                <td>{{ ($k_pkrjn['5'] == null ) ? '-' : $k_pkrjn['5'] }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-primary mt-4" id="cetakDataKaryawan">{{ __('Cetak PDF') }}</a>
                <div class="btn-group dropright">
                <a type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 24px;">
                        Download
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="btn-cv" href="#"><i class="ikon ni ni-single-02"></i>CV</a>
                            <a class="dropdown-item" id="btn-ktp" href="#" target="_blank"><i class="ni ni-badge"></i>KTP</a>
                            <a class="dropdown-item" id="btn-kk" href="#" target="_blank"><i class="ni ni-books"></i>KK</a>
                            <a class="dropdown-item" id="btn-f-diri" href="#" target="_blank"><i class="ni ni-circle-08"></i>Foto Diri</a>
                        </div>
                        <script>
                            var pathname = window.location.origin + '/file_upload/<?= $user->employee_id ?>/<?= $user->resume ?>';
                            $("#btn-cv").attr("href", pathname);
                            var pathname = window.location.origin + '/file_upload/<?= $user->employee_id ?>/<?= $user->f_diri ?>';
                            $("#btn-f-diri").attr("href", pathname);
                            var pathname = window.location.origin + '/file_upload/<?= $user->employee_id ?>/<?= $user->f_ktp ?>';
                            $("#btn-ktp").attr("href", pathname);
                            var pathname = window.location.origin + '/file_upload/<?= $user->employee_id ?>/<?= $user->f_kk ?>';
                            $("#btn-kk").attr("href", pathname);
                        </script>
                </div>
            </div>
        </div>
          </div>
        </div>
    </div>
  </div>
</div>
<script>
    //get id from url
    var id = location.pathname.split('/')[6];
    var url = "{{ url('/admin/hr/pdf-data-karyawan') }}" + '/' + id;
    $("#cetakDataKaryawan").attr("href", url);

</script>

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
