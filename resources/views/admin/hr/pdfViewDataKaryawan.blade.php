<!DOCTYPE html>
<html>
<head>
	<title>Informasi Kepegawaian</title>
    <style>
        td{
            vertical-align:top
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="table-responsive-md">
            <table class="tabel" border="0" style="width: 100%;line-height: 30px;">
                <tbody>
                    <tr>
                    <th colspan="6"><center>DATA INDUK KARYAWAN</center></th></tr>
                    <tr>
                        <td rowspan="10"><img src="{{ asset("file_upload/$user->employee_id/$user->f_diri") }}" alt="" style="width: 210px;height: 270px;"></td>
                        <td>NIK</td>
                        <td>: {{ ($user->ktp == null) ? '-' : $user->ktp }}</td>
                        <td>Tgl. Masuk</td>
                        <td>: {{ ($user->join_date == null) ? '-' : $user->join_date }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: {{ ($user->jabatan == null) ? '-' : $user->jabatan }}</td>
                        <td>Kantor</td>
                        <td>: {{ ($user->user_status  == 'aktif') ? 'PT Sahabat Sakinah Senter' : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Divisi</td>
                        <td>: {{ ($user->jabatan == 'Desk Collection' || $user->jabatan == 'Leader DC' ? 'Collection' : $user->divisi) }}</td>
                        <td>Status</td>
                        <td>: TK  /  K0  /  K1  /  K2  /  K3  /  K4</td>
                    </tr>
                </tbody>
            </table>
            <hr style="margin-top:-60px;">
            <table class="tabel" border="0" style="width: 100%;line-height: 30px;">
                <tbody>
                    <tr>
                    <th colspan="6"><center>IDENTITAS DIRI</center></th></tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>: {{ ($user->fullname == null) ? '-' : $user->fullname }}</td>
                        <td>Agama</td>
                        <td>: {{ ($user->agama == null) ? '-' : $user->agama }}</td>
                    </tr>
                    <tr>
                        <td>No. KTP</td>
                        <td>: {{ ($user->ktp == null) ? '-' : $user->ktp }}</td>
                        <td>Golongan Darah</td>
                        <td>: {{ ($user->golongan_darah  == null ) ? '-' : $user->golongan_darah }}</td>
                    </tr>
                    <tr>
                        <td>No. KK</td>
                        <td>: {{ ($user->kk == null) ? '-' : $user->kk }}</td>
                        <td>Nama Ibu Kandung</td>
                        <td>: {{ ($user->n_ibu_kandung == null) ? '-' : $user->n_ibu_kandung }}</td>
                    </tr>
                    <tr>
                        <td>No. NPWP</td>
                        <td>: {{ ($user->npwp == null ) ? '-' : $user->npwp }}</td>
                        <td>Tempat / TGL. Lahir</td>
                        <td>: {{ $user->tempat_lahir }} / {{ $user->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Status Pernikahan</td>
                        <td>: {{ ($user->status_pernikahan == null) ? '-' : $user->status_pernikahan }}</td>
                        <td>Kewarganegaraan</td>
                        <td>: {{ ($user->kewarganegaraan == null) ? '-' : $user->kewarganegaraan }}</td>
                    </tr>
                    <tr>
                        <td>Alamat <br>(Domisili)</td>
                        <td>: {{ ($user->almt_domisili == null) ? '-' : $user->almt_domisili }}</td>
                        <td>Alamat <br>(Sesuai KTP)</td>
                        <td>: {{ ($user->almt_ktp == null) ? '-' :  $user->almt_ktp}}</td>

                    </tr>
                    <tr>
                        <td>No. Telp Rumah</td>
                        <td>: {{ ($user->tlp_rumah == null) ? '-' : $user->tlp_rumah }}</td>
                        <td>Media Sosial</td>
                        <td>: {{ ($user->sosmed == null) ? '-' : $user->sosmed }}</td>
                    </tr>
                    <tr>
                        <td>No. HP / CDMA</td>
                        <td>: {{ ($user->tlp_hp == null) ? '-' :  $user->tlp_hp}}</td>
                        <td>Suku</td>
                        <td>: {{ ($user->suku == null) ? '-' :  $user->suku}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: {{ ($user->email == null) ? '-' : $user->email }}</td>
                    </tr>
                </tbody>
            </table>
            {{--  <hr style="margin-top:-60px;">  --}}
            <hr>
            <table class="tabel" border="0" style="width: 100%;line-height: 30px;">
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
            <hr>
            <table class="tabel" border="0" style="width: 100%;line-height: 30px;">
                <tbody>
                    <tr>
                    <th colspan="6"><center>SUSUNAN ANGGOTA KELUARGA ( Ayah, Ibu, Saudara kandung, Termasuk Diri Anda )</center></th></tr>
                    <tr>
                        <th>Anggota</th>
                        <th>Nama</th>
                        <th>TGL. Lahir</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                    </tr>
                    <tr>
                        <td>Ayah</td>
                        <td>{{ $anggota['0'] }}</td>
                        <td>{{ $tgl_anggota['0'] }}</td>
                        <td>{{ $pendidikan_anggota['0'] }}</td>
                        <td>{{ $pekerjaan_anggota['0'] }}</td>
                    </tr>
                    <tr>
                        <td>Ibu</td>
                        <td>{{ $anggota['1'] }}</td>
                        <td>{{ $tgl_anggota['1'] }}</td>
                        <td>{{ $pendidikan_anggota['1'] }}</td>
                        <td>{{ $pekerjaan_anggota['1'] }}</td>
                    </tr>
                    <tr>
                        <td>Anak ke 1</td>
                        <td>{{ ($anggota['2'] == null) ? '-' : $anggota['2'] }}</td>
                        <td>{{ ($tgl_anggota['2'] == null) ? '-' : $tgl_anggota['2'] }}</td>
                        <td>{{ ($pendidikan_anggota['2'] == null) ? '-' : $pendidikan_anggota['2'] }}</td>
                        <td>{{ ($pekerjaan_anggota['2'] == null) ? '-' : $pekerjaan_anggota['2']}}</td>
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
            <hr>
            <table class="tabel" border="0" style="width: 100%;line-height: 30px;">
                <tbody>
                    <tr>
                    <th colspan="6"><center>SUSUNAN KELUARGA Anda ( Suami/Istri, Mertua, dan Anak Anda )</center></th></tr>
                    <tr>
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

	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
