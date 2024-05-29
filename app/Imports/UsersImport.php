<?php

namespace App\Imports;

use App\User;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use DateTime;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;




class UsersImport implements ToModel, SkipsEmptyRows, WithValidation ,WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        // dd($row['suku']);
	    // $dateJoin = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['join_date'])->format('Y-m-d');
	    // $dateBirth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir'])->format('Y-m-d');
        $dateJoin = Carbon::createFromFormat('d/m/Y', $row['join_date'])->format('Y-m-d');
        $dateBirth = Carbon::createFromFormat('d/m/Y', $row['tgl_lahir'])->format('Y-m-d');
        // susunan keluarga
        $keluarga_orangatua = [
            'nama_ayah' => $row['sak_ayah'],
            // 'tgl_lahir_ayah' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_ayah'])->format('Y-m-d'),
            'tgl_lahir_ayah' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_ayah'])->format('Y-m-d'),
            'pendidikan_ayah' => $row['pendidikan_ayah'],
            'pekerjaan_ayah' => $row['pekerjaan_ayah'],
            'nama_ibu' => $row['sak_ibu'],
            // 'tgl_lahir_ibu' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_ibu'])->format('Y-m-d'),
            'tgl_lahir_ibu' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_ibu'])->format('Y-m-d'),
            'pendidikan_ibu' => $row['pendidikan_ibu'],
            'pekerjaan_ibu' => $row['pekerjaan_ibu'],
            'nama_anak1' => $row['sak_anak1'],
            // 'tgl_lahir_anak1' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_anak1'])->format('Y-m-d'),
            'tgl_lahir_anak1' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_anak1'])->format('Y-m-d'),
            'pendidikan_anak1' => $row['pendidikan_anak1'],
            'pekerjaan_anak1' => $row['pekerjaan_anak1'],
            'nama_anak2' => $row['sak_anak2'],
            // 'tgl_lahir_anak2' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_anak2'])->format('Y-m-d'),
            'tgl_lahir_anak2' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_anak2'])->format('Y-m-d'),
            'pendidikan_anak2' => $row['pendidikan_anak2'],
            'pekerjaan_anak2' => $row['pekerjaan_anak2'],
            'nama_anak3' => $row['sak_anak3'],
            // 'tgl_lahir_anak3' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_anak3'])->format('Y-m-d'),
            'tgl_lahir_anak3' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_anak3'])->format('Y-m-d'),
            'pendidikan_anak3' => $row['pendidikan_anak3'],
            'pekerjaan_anak3' => $row['pekerjaan_anak3'],
            'nama_anak4' => $row['sak_anak4'],
            // 'tgl_lahir_anak4' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_anak4'])->format('Y-m-d'),
            'tgl_lahir_anak4' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_anak4'])->format('Y-m-d'),
            'pendidikan_anak4' => $row['pendidikan_anak4'],
            'pekerjaan_anak4' => $row['pekerjaan_anak4'],
            'nama_anak5' => $row['sak_anak5'],
            // 'tgl_lahir_anak5' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_anak5'])->format('Y-m-d'),
            'tgl_lahir_anak5' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_anak5'])->format('Y-m-d'),
            'pendidikan_anak5' => $row['pendidikan_anak5'],
            'pekerjaan_anak5' => $row['pekerjaan_anak5'],
        ];
        $susunan_keluarga_sendiri = [
            'nama_suami_istri' => $row['ska_suami_istri'],
            // 'tgl_lahir_suami_istri' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir_suami_istri'])->format('Y-m-d'),
            'tgl_lahir_suami_istri' => Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_suami_istri'])->format('Y-m-d'),
            'pendidikan_suami_istri' => $row['pendidikan_suami_istri'],
            'pekerjaan_suami_istri' => $row['pekerjaan_suami_istri'],
            'ska_anak1' => $row['ska_anak1'],
            'ska_pendidikan_anak1' => $row['ska_pendidikan_anak1'],
            // 'ska_tgl_lahir_anak1' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ska_tgl_lahir_anak1'])->format('Y-m-d'),
            'ska_tgl_lahir_anak1' => Carbon::createFromFormat('d/m/Y', $row['ska_tgl_lahir_anak1'])->format('Y-m-d'),
            'ska_pekerjaan_anak1' => $row['ska_pekerjaan_anak1'],
            'ska_anak2' => $row['ska_anak2'],
            'ska_pendidikan_anak2' => $row['ska_pendidikan_anak2'],
            // 'ska_tgl_lahir_anak2' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ska_tgl_lahir_anak2'])->format('Y-m-d'),
            'ska_tgl_lahir_anak2' => Carbon::createFromFormat('d/m/Y', $row['ska_tgl_lahir_anak2'])->format('Y-m-d'),
            'ska_pekerjaan_anak2' => $row['ska_pekerjaan_anak2'],
            'ska_anak3' => $row['ska_anak3'],
            'ska_pendidikan_anak3' => $row['ska_pendidikan_anak3'],
            // 'ska_tgl_lahir_anak3' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ska_tgl_lahir_anak3'])->format('Y-m-d'),
            'ska_tgl_lahir_anak3' => Carbon::createFromFormat('d/m/Y', $row['ska_tgl_lahir_anak3'])->format('Y-m-d'),
            'ska_pekerjaan_anak3' => $row['ska_pekerjaan_anak3'],
            'ska_anak4' => $row['ska_anak4'],
            'ska_pendidikan_anak4' => $row['ska_pendidikan_anak4'],
            // 'ska_tgl_lahir_anak4' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ska_tgl_lahir_anak4'])->format('Y-m-d'),
            'ska_tgl_lahir_anak4' => Carbon::createFromFormat('d/m/Y', $row['ska_tgl_lahir_anak4'])->format('Y-m-d'),
            'ska_pekerjaan_anak4' => $row['ska_pekerjaan_anak4'],
            'ska_anak5' => $row['ska_anak5'],
            'ska_pendidikan_anak5' => $row['ska_pendidikan_anak5'],
            // 'ska_tgl_lahir_anak5' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ska_tgl_lahir_anak5'])->format('Y-m-d'),
            'ska_tgl_lahir_anak5' => Carbon::createFromFormat('d/m/Y', $row['ska_tgl_lahir_anak5'])->format('Y-m-d'),
            'ska_pekerjaan_anak5' => $row['ska_pekerjaan_anak5'],
        ];
        // dd($susunan_keluarga_sendiri);
        // sosmed
        $sosmed = [
            'sosmed1' => $row['sosmed1'],
            'sosmed2' => $row['sosmed2'],
        ];
        // alamat ktp & domisili
        $alamat_domisili = $row['alamat_domisili'].' RT/RW '.$row['rt_rw_domisili'].' Kel.'.$row['kelurahan_domisili'].', Kec.'.$row['kecamatan_domisili'].' , Kota/Kab '.$row['kotakab_domisili'].' , Kode pos '.$row['kode_post_domisili'];
        $alamat_ktp = $row['alamat_ktp'].' RT/RW '.$row['rt_rw_ktp'].' '.$row['kelurahan_ktp'].', Kec.'.$row['kecamatan_ktp'].' , Kota/Kab '.$row['kotakab_ktp'].' , Kode pos '.$row['kode_post_ktp'];
        // pendidikan
        $sekolah1 = [
            'jenjang1' => $row['jenjang_pendidikan'],
            'nama_jurusan1' => $row['nama_jurusan'],
            'nama1' => $row['nama_institusi'],
            'thn_masuk1' => null,
            'thn_masuk1' => null
        ];
        $sekolah2 = [
            'jenjang2' => null,
            'nama_jurusan2' => null,
            'nama2' => null,
            'thn_masuk2' => null,
            'thn_masuk2' => null
        ];
        $sekolah3 = [
            'jenjang3' => null,
            'nama_jurusan3' => null,
            'nama3' => null,
            'thn_masuk3' => null,
            'thn_masuk3' => null
        ];
        $pendidikan = [
            'sekolah1' => $sekolah1,
            'sekolah2' => $sekolah2,
            'sekolah3' => $sekolah3,
        ];
        // emergency contact
        $ec1 = [
            'nama_ec1' => $row['nama_ec1'],
            'hub_ec1' => $row['hubungan_ec1'],
            'nomor_ec1' => $row['no_ec1'],
        ];
        $ec2 = [
            'nama_ec2' => $row['nama_ec2'],
            'hub_ec2' => $row['hubungan_ec2'],
            'nomor_ec2' => $row['no_ec2'],
        ];
        // pengalaman kerja
        $pengalaman1 = [
            'nama1' => $row['nama_instansi'],
            'tgl_msk1' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_masuk'])->format('d-m-Y'),
            'tgl_klr1' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_keluar'])->format('d-m-Y'),
            'jbtn1' => $row['jobdesk'],
            'salary_tkhr1' => $row['salary_terakhir']
        ];
        $pengalaman2 = [
            'nama2' => null,
            'tgl_msk2' => null,
            'tgl_klr2' => null,
            'jbtn2' => null,
            'salary_tkhr2' => null,
        ];
        $p_kerja = [
            'pengalaman1' => $pengalaman1,
            'pengalaman2' => $pengalaman2
        ];

	    $user = new User([
                'employee_id' => $row['employee_id'],
                'fullname' => $row['fullname'],
                'join_date'=> $dateJoin,
                'tempat_lahir' => $row['tpt_lahir'],
                'tanggal_lahir' => $dateBirth,
                'almt_domisili' => $alamat_domisili,
	            'almt_ktp' => $alamat_ktp,
		        'tlp_rumah' => $row['telp_rumah'],
                'tlp_hp' => $row['telp_hp'],
                'ec1' => json_encode($ec1),
                'ec2' => json_encode($ec2),
		        'ktp' => $row['ktp'],
                'kk' => $row['kk'],
                'npwp' => $row['npwp'],
                'passport' => $row['passport'],
                'email' => $row['email'],
                // 'jabatan' => $row['jabatan'],
                'agama' => $row['agama'],
                'pendidikan' => json_encode($pendidikan),
                'status_pernikahan' => $row['status_pernikahan'],
                'kewarganegaraan' => $row['kewarganegaraan'],
                'golongan_darah' => $row['golongan_darah'],
                'n_ibu_kandung' => $row['nama_ibu_kandung'],
                'suku' => $row['suku'],
                's_keluraga_orangtua' => json_encode($keluarga_orangatua),
                's_keluarga_sendiri' => json_encode($susunan_keluarga_sendiri),
                'sosmed' => json_encode($sosmed),
                'p_kerja' => json_encode($p_kerja),
                'password' => $row['employee_id']]);
        // dd($user);
        $role_r = Role::where('name', '=', $row['jabatan'])->get();
        return $user->assignRole($role_r);

    }

    // //rule untuk mengecek data yang sama stop ketika ada yang sama atau ada validasi yang error
    public function rules(): array
    {
        return [
            'employee_id' => 'nullable|unique:users,employee_id',
            //'fullname' => 'nullable|unique:users,fullname',


        ];
    }

    // //validasi sama akan memberika messages
    public function customValidationMessages()
    {
        return [
	    'employee_id' => 'employee_id sama',
            //'fullname' => 'fullname sama',
        ];
    }
}
