<?php

namespace App\Http\Controllers\admin;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HRController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ke view hr
    public function index()
    {
        $dataRole = Role::where('name','!=','Super Admin')->get();
        return view('admin.hr.index',['dataRole'=>$dataRole]);
    }

    public function editUser($id)
    {
        // SELECT id AS USER_ID, employee_id,ktp,kk,passport,npwp,fullname,almt_ktp,almt_domisili,tempat_lahir,tanggal_lahir,email,tlp_hp,tlp_rumah,jabatan,divisi,agama,status_pernikahan,kewarganegaraan,golongan_darah,passport FROM `users`;
        // $dataUser = User::find($id);
        // $dataUser = DB::select("SELECT * from users where user.id as userid = '$id' join roles where role.name as role_name == users.jabatan");
        // $dataUser = User::where((DB::select('SELECT id as users_id'))),$id)->get();
        // $Role = Role::where('name',User::find($id)->jabatan)->get();
        $usersDetails = DB::table('users')
            ->Where('users.id','=',$id)
            ->join('roles', 'users.jabatan', '=', 'roles.name')// joining the contacts table , where user_id and contact_user_id are same
            // ->select('users.*', 'roles.id as role_id')
            ->get();
            // dd($usersDetails);
        // return view('admin.hr.uploadFile',['dataUser'=>$dataUser]);
        // return [$dataUser,$Role];
        return $usersDetails;
    }

    // ke view tabel user yang tidak aktif
    public function viewUserTidakAktif(){
        return view('admin.hr.pegawaiTidakAktif');
    }

    //data table user
    public function getDataUser($id){
        if($id == 1){
            // $users = User::where('email','!=','admin@local.host')->where('user_status','!=','aktif')->get();
            $users = User::whereNotIn('fullname',['Super Admin'])
            ->whereNotIn('fullname',['akun hrd'])
            ->where('user_status','!=','aktif')
            ->orderBy('id', 'ASC')
            ->get();
        }else{
            $users = User::whereNotIn('fullname',['Super Admin'])
            ->whereNotIn('fullname',['akun hrd'])
            ->where('user_status','!=','tidak aktif')
            ->where('user_status','!=','disabled')
            ->orderBy('id', 'ASC')
            ->get();
        }
        // dd($users);
        $tb = Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('employee_id', function($user){
                    return ($user->employee_id != null) ? $user->employee_id : 'employee_id kosong';
                })
                ->addColumn('full_name', function($user){
                    return $user->NamaLengkap;
                })
                ->addColumn('ktp', function($user){
                    return ($user->ktp != null) ? $user->ktp : '-';
                })
                ->addColumn('passport', function($user){
                    return ($user->passport != null) ? $user->passport : '-';
                })
                ->addColumn('domisili ', function($user){
                    // dd($data->domisili);
                    return ($user->almt_domisili) ? $user->almt_domisili : '-';
                })
                ->addColumn('no_hp ', function($user){
                    return ($user->tlp_hp  != null) ? $user->tlp_hp  : '-';
                })
                ->addColumn('noteUser', function($user){
                    $data = json_decode($user->note);
                    $note = '';
                    if(json_decode($user->note) == null){
                        $note .= '-';
                    }elseif((!empty(json_decode($user->note)->note2)) && (!empty(json_decode($user->note)->note3))){
                        $note .= $data->note3;
                    }elseif((!empty(json_decode($user->note)->note1)) && (!empty(json_decode($user->note)->note2))){
                        $note .= $data->note2;
                    }else{
                        $note .= $data->note1;
                    }
                    return $note;
                    // return $user->note;
                })
                ->addColumn('status', function($data){
                    $return = "";
                        if($data->user_status == 'aktif' && $data->user_status != null){
                            $return .= '<a style="color: green;" title="Menonaktifkan Karyawan">Aktif</a>';
                            // onclick="nonaktif_user('.$data->id.')"
                        }elseif($data->user_status == 'tidak aktif'){
                            $return .= '<a style="color: red;" title="Mengaktifkan Karyawan">Non Aktif</a>';
                        }else{
                            $return .= '<a style="color: gray;" title="Can not apply">Can not apply</a>';
                        }
                    return $return;
                })

                ->addColumn('action', function($data){
                    $user = auth()->user();
                    $buttonAction = "";

                    $btnEmployee = "";
                    if($data->user_status == 'aktif' && $data->user_status != null){ //mengecek apakah user aktif atau tidak
                        $btnEmployee = '<a href="#" class="dropdown-item" onclick="nonaktif_user('.$data->id.')"><i class="ikon ni ni-single-02"></i>Non Aktifkan Karyawan</a>';
                    }else{
                        if($data->user_status != 'disabled'){
                            $btnEmployee = '<a href="#" class="dropdown-item" onclick="aktif_user('.$data->id.')"><i class="ikon ni ni-single-02"></i>Aktifkan Karyawan</a>';
                        }else{
                            $btnEmployee = '<a class="dropdown-item disabled"><i class="ikon ni ni-single-02"></i>Can not apply</a>';
                        }

                    }

                    if($user->hasAnyRole(['HR Manager','Super Admin','HR Staff Senior'])){ //menu button untuk hr manager, HR Senior ,dan super admin
                    $buttonAction .='
                            <div class="btn-group dropleft">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="editUser('. $data->id .')"><i class="ikon ni ni-single-02"></i>Ubah Data Karyawan</a>
                                    '.$btnEmployee.'
                                    <a class="dropdown-item disabled"><i class="ikon ni ni-single-02"></i>Lihat Data Karyawan</a>
                                </div>
                            </div>
                        </div>';
                        // <a class="dropdown-item disabled">Lihat Data Karyawan</a>
                    }
                    if($user->hasAnyRole(['HR Staff'])){ //menu untuk hr staff
                    $buttonAction .='
                        <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="editUser('. $data->id .')"><i class="ikon ni ni-single-02"></i>Ubah Data Karyawan</a>
                            </div>
                        </div>
                    </div>';
                    }
                    return $buttonAction;
                    })
                    ->escapeColumns([])
                    ->make(true);
            return $tb;
    }

    // ke view upload data
    public function uploadDataView(){
        // $getLastIDSSS = DB::table('users')->latest('created_at')->first();
        $getLastIDSSS = User::orderBy('id', 'desc')->first();
        $strPlus = preg_replace("/[^a-zA-Z0-9]/", "", filter_var($getLastIDSSS->employee_id, FILTER_SANITIZE_NUMBER_INT)) + 1;
        $next_employee = 'ID-SSS'.$strPlus;
        $dataRole = Role::where('name','!=','Super Admin')->get();
        // dd($next_employee);
        return view('admin.hr.uploadFile',['dataRole'=>$dataRole,'last_employee'=>$next_employee]);
        // return view('admin.hr.uploadFile');
    }

    // insert user by upload excel and save file excel in public file/DataKaryawan
    public function uploadData(Request $request){
        Excel::import(new UsersImport,  $request->file('file_excel_karyawan'));
        return redirect()->route('hr');
    }

    //download tamplate excel user
    public function getTamplateExcel(){
        // $filepath = public_path('storage/format_data_karyawan/Data Karyawan.xlsx');
        $filepath = storage_path('format_data_karyawan/Data Karyawan.xlsx');
        // dd(file_exists($filepath));
        if (file_exists($filepath)) {
            return Response()->download($filepath);
        }
    }

    //edit status by id user
    public function editstatus($id){
        $dataUser = User::find($id);
        $data = "";
        if($dataUser->user_status == 'aktif'){
            $data .= $dataUser->update(['user_status'=>'tidak aktif']);
        }else{
            $dataNote = json_decode($dataUser->note);
            $note = [
                'note1'=>$dataNote->note1,
                'dateRecord' => $dataNote->dateRecord,
                'dateAktifUser' => ($dataNote->note2 == null) ? Carbon::now()->isoFormat('DD/MM/YYYY') : $dataNote->dateAktifUser,
                'note2'=>$dataNote->note2,
                'dateRecord2' => $dataNote->dateRecord2,
                'dateAktifUser2' => ($dataNote->dateAktifUser != null) ? Carbon::now()->isoFormat('DD/MM/YYYY') : $dataNote->dateAktifUser2
            ];
            // dd($note['dateAktifUser'] != null);
            if($dataUser->user_status){
                $data .= $dataUser->update(['user_status'=>'aktif','note'=>json_encode($note)]);
            }
        }
        return $data;
        // $status_user = User::find($id);
        // $data = "";
        // if($status_user->user_status == 'tidak aktif'){
        //     $dataNote = json_decode($status_user->note);
        //     $note = [
        //         'note1'=>$dataNote->note1,
        //         'dateRecord' => $dataNote->dateRecord,
        //         'dateAktifUser' => $dataNote->dateAktifUser,
        //         'note2'=>$dataNote->note2,
        //         'dateRecord2' => $dataNote->dateRecord2,
        //         'dateAktifUser2' => ($dataNote->note2 != null) ? null : Carbon::now()->isoFormat('DD/MM/YYYY')
        //     ];

        //     if($dataNote->note2 != null){
        //         $data .= User::find($id)->update(['user_status'=>'aktif','note'=>$note]);
        //     }
        //     // else{
        //     //     return redirect()->back()->with('failedActivaUser', 'Gagal mengaktifkan karyawan karena karyawan sudah mencapai batas pengaktifan !');
        //     // }
        //     // $data .= User::find($id)->update(['user_status'=>'tidak aktif']);
        //     // return redirect()->back()->with('FailedChangePwd', 'Password yang Anda Masukkan Tidak Cocok Silahkan Coba Kembali');
        //     // if
        //     // $data .= User::find($id)->update(['user_status'=>'aktif']);
        // }

        // return $data;
    }

    public function deactiveUser(Request $request){
        $validator = Validator::make($request->all(), [
            'dateNote'=>'required|string|min:3',
        ]);

        $dataUser = User::find($request->id);
        $data = "";
        if($dataUser->user_status == 'aktif'){
            $UpdateStatusUser = 'tidak aktif';
            // $dateNonAktifUser = $request->dateNote;
            $dateRecord = Carbon::now()->isoFormat('DD/MM/YYYY');
            if($dataUser->note == '' || $request->dateNote == null){
                $data .= $dataUser->update(['user_status'=>'tidak aktif']);

                // limit note max 2x
                // dd(json_decode($getNoteUserById->note) == null);
                if(!empty($request->noteValue)){
                    // cek apakah note sudah ada apa tidak jika kosong maka insert baru
                    if(json_decode($dataUser->note) == null){
                        $note = [
                            'note1'=>$request->noteValue,
                            'dateRecord' => $dateRecord,
                            'dateAktifUser' => null,
                            'note2'=> null,
                            'dateRecord2' => null,
                            'dateAktifUser2' => null
                        ];
                        $getDataUserById = $dataUser->update(['note'=>json_encode($note)]);
                        return 'user telah di nonaktifkan dan diberikan note'. $request->noteValue;
                    }
                    // jika note1 sudah ada maka membuat note2
                    elseif(json_decode($dataUser->note)->note1 != null){
                        $note = [
                            'note1'=>json_decode($dataUser->note)->note1,
                            'dateRecord' => json_decode($dataUser->note)->dateRecord,
                            'dateAktifUser' => json_decode($dataUser->note)->dateAktifUser,
                            'note2'=>$request->noteValue,
                            'dateRecord2' => $dateRecord,
                            'dateAktifUser2' => (json_decode($dataUser->note)->dateAktifUser2 != null) ? json_decode($dataUser->note)->dateAktifUser2 : null
                        ];
                        $getDataUserById = $dataUser->update(['user_status'=>'disabled','note'=>json_encode($note)]);
                        return 'user telah di nonaktifkan dan diberikan note'. $request->noteValue;
                    }
                    // jika note1 sudah ada maka membuat mengubah status user menjadi disabled
                    // elseif(json_decode($dataUser->note)->note2 != null){
                    //     // $note = [
                    //     //     'note1'=>json_decode($dataUser->note)->note1,
                    //     //     'dateRecord' => json_decode($dataUser->note)->dateRecord,
                    //     //     'dateAktifUser' => json_decode($dataUser->note)->dateAktifUser,
                    //     //     'note2'=>json_decode($dataUser->note)->note2,
                    //     //     'dateRecord2' => json_decode($dataUser->note)->dateRecord2,
                    //     //     'dateAktifUser2' => json_decode($dataUser->note)->dateAktifUser2
                    //     // ];
                    //     $getDataUserById = $dataUser->update(['user_status'=>'disabled']);
                    //     return 'user telah di nonaktifkan dan diberikan note'. $request->noteValue;
                    // }
                    else{
                        return redirect()->back()->with('failedDeactiveUser', 'Gagal memberi note pada Karyawan');
                    }
                }
            }

        }
        return $data;
    }

    // inser user
    public function create(Request $request)
    {
        // dd($request);
        // die();
        $jabatan = Role::find($request['jabatan']);
        // mengambil id yang terbesar dari db
        $getLastIDSSS = User::orderBy('employee_id', 'desc')->value('employee_id');
        // setelah id nya di ambil lalu diambil angkanya langsung di tambahkan 1
        $strPlus = preg_replace("/[^a-zA-Z0-9]/", "", filter_var($getLastIDSSS, FILTER_SANITIZE_NUMBER_INT)) + 1;
        $idUser = 'ID-SSS'.$strPlus;

        $validator = Validator::make($request->all(), [
            'idSSS' => 'required|string|nullable',
            'ktp' => 'required|string|min:8|unique:users',
            'kk' => 'string|nullable',
            'passport' => 'string|nullable',
            'nwpwp' => 'string|nullable',
            'name'=>'required|string|max:255|min:3',
            'no_hp' => 'required|string|min:5',
            'no_telp' => 'required|string|min:5',
            'no_ec1' => 'required',
            'no_ec2' => 'required',
            'nama_ec1' => 'required',
            'nama_ec2' => 'required',
            'hub_ec1' => 'required',
            'hub_ec2' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'email' =>'required|string|email|max:255|min:3|unique:users',
            'passport' =>'string|nullable',
            'nama_ibu' => 'required|string|min:3',
            'password'=>'required|min:6|confirmed',
            'sosmed'=>'string|nullable',
            // 'ec_families'=>'string|nullable',
            //json format graduated_from graduated_from:{SD:{'nama':'','jurusan':'','program':'',....}} for future use.
            // 'graduated_from'=>'string|nullable',

        ]);
        // alamat lengkap
        $alamat_ktp = $request['alamat_ktp'].' RT/RW '.$request['rt_rw_ktp'].' Kel.'.$request['kelurahan_ktp'].', Kec.'.$request['kecamatan_ktp'].' , Kota/Kab '.$request['kota_kab_ktp'].' , Kode pos '.$request['kode_post_ktp'];
        $alamat_domisili = $request['alamat_domisili'].' RT/RW '.$request['rt_rw_domisili'].' Kel.'.$request['kelurahan_domisili'].', Kec.'.$request['kecamatan_domisili'].' , Kota/Kab '.$request['kota_kab_domisili'].' , Kode pos '.$request['kode_post_domisili'];
        // kontak darurat
        $ec1 = [
            'nama_ec1' => $request['nama_ec1'],
            'hub_ec1' => $request['hub_ec1'],
            'nomor_ec1' => $request['no_ec1'],
        ];
        $ec2 = [
            'nama_ec2' => $request['nama_ec2'],
            'hub_ec2' => $request['hub_ec2'],
            'nomor_ec2' => $request['no_ec2'],
        ];
        // pendidikan
        $sekolah1 = [
            'jenjang1' => $request['pendidikan_1'],
            'nama_jurusan1' => $request['jurusan1'],
            'nama1' => $request['sekolah1'],
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
        // pengalaman kerja
        $pengalaman1 = [
            'nama1' => $request['perusahaan1'],
            'tgl_msk1' => $request['tanggal_masukkerja1'],
            'tgl_klr1' => $request['tanggal_keluarkerja1'],
            'jbtn1' => $request['jabatan1'],
            'salary_tkhr1' => $request['gaji_terakhir1']
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
        // susunan keluarga
        $keluarga_orangatua = [
            'nama_ayah' => $request['nama_ayah'],
            'tgl_lahir_ayah' => $request['tgl_lahir_ayah'],
            'pendidikan_ayah' => $request['Pendidikan_terakhir_ayah'],
            'pekerjaan_ayah' => $request['pekerjaan_ayah'],
            'nama_ibu' => $request['sak_ibu'],
            'tgl_lahir_ibu' => $request['tgl_lahir_ibu'],
            'pendidikan_ibu' => $request['Pendidikan_terakhir_ibu'],
            'pekerjaan_ibu' => $request['pekerjaan_ibu'],
            'nama_anak1' => $request['nama_anak1'],
            'tgl_lahir_anak1' => $request['tgl_lahir_anak1'],
            'pendidikan_anak1' => $request['Pendidikan_terakhir_anak1'],
            'pekerjaan_anak1' => $request['pekerjaan_anak1'],
            'nama_anak2' => $request['nama_anak2'],
            'tgl_lahir_anak2' => $request['tgl_lahir_anak2'],
            'pendidikan_anak2' => $request['Pendidikan_terakhir_anak2'],
            'pekerjaan_anak2' => $request['pekerjaan_anak2'],
            'nama_anak3' => $request['nama_anak3'],
            'tgl_lahir_anak3' => $request['tgl_lahir_anak3'],
            'pendidikan_anak3' => $request['Pendidikan_terakhir_anak3'],
            'pekerjaan_anak3' => $request['pekerjaan_anak3'],
            'nama_anak4' => $request['nama_anak4'],
            'tgl_lahir_anak4' => $request['tgl_lahir_anak4'],
            'pendidikan_anak4' => $request['Pendidikan_terakhir_anak4'],
            'pekerjaan_anak4' => $request['pekerjaan_anak4'],
            'nama_anak5' => $request['nama_anak5'],
            'tgl_lahir_anak5' => $request['tgl_lahir_anak5'],
            'pendidikan_anak5' => $request['Pendidikan_terakhir_anak5'],
            'pekerjaan_anak5' => $request['pekerjaan_anak5'],
        ];
        $susunan_keluarga_sendiri = [
            'nama_suami_istri' => $request['nama_suami_istri'],
            'tgl_lahir_suami_istri' => $request['tgl_lahir_suami_istri'],
            'pendidikan_suami_istri' => $request['Pendidikan_terakhir_suami_istri'],
            'pekerjaan_suami_istri' => $request['pekerjaan_suami_istri'],
            'ska_anak1' => $request['nama_ska_anak1'],
            'ska_pendidikan_anak1' => $request['Pendidikan_terakhir_ska_anak1'],
            'ska_tgl_lahir_anak1' => $request['tgl_lahir_ska_anak1'],
            'ska_pekerjaan_anak1' => $request['pekerjaan_ska_anak1'],
            'ska_anak2' => $request['nama_ska_anak2'],
            'ska_pendidikan_anak2' => $request['Pendidikan_terakhir_ska_anak2'],
            'ska_tgl_lahir_anak2' => $request['tgl_lahir_ska_anak2'],
            'ska_pekerjaan_anak2' => $request['pekerjaan_ska_anak2'],
            'ska_anak3' => $request['nama_ska_anak3'],
            'ska_pendidikan_anak3' => $request['Pendidikan_terakhir_ska_anak3'],
            'ska_tgl_lahir_anak3' => $request['tgl_lahir_ska_anak3'],
            'ska_pekerjaan_anak3' => $request['pekerjaan_ska_anak3'],
            'ska_anak4' => $request['nama_ska_anak4'],
            'ska_pendidikan_anak4' => $request['Pendidikan_terakhir_ska_anak4'],
            'ska_tgl_lahir_anak4' => $request['tgl_lahir_ska_anak4'],
            'ska_pekerjaan_anak4' => $request['pekerjaan_ska_anak4'],
            'ska_anak5' => $request['nama_ska_anak5'],
            'ska_pendidikan_anak5' => $request['Pendidikan_terakhir_ska_anak5'],
            'ska_tgl_lahir_anak5' => $request['tgl_lahir_ska_anak5'],
            'ska_pekerjaan_anak5' => $request['pekerjaan_ska_anak5'],
        ];
        $data = [
            'employee_id' => $request['idSSS'],
            'ktp' => $request['ktp'],
            'kk' => $request['kk'],
            'passport' => $request['passport'],
            'npwp' => $request['npwp'],
            'fullname' => $request['name'],
            'almt_ktp' => $alamat_ktp,
            'almt_domisili' => $alamat_domisili,
            'tlp_hp' => $request['no_hp'],
            'tlp_rumah' => $request['no_telp'],
            'ec1' => json_encode($ec1),
            'ec2' => json_encode($ec2),
            'tempat_lahir' => $request['tempat_lahir'],
            'tanggal_lahir' => Carbon::createFromFormat('d/m/Y', $request['tanggal_lahir'])->format('Y-m-d'),
            'email' => $request['email'],
            'tlp_rumah' => $request['telp_rumah'],
            'tlp_hp' => $request['telp_hp'],
            'jabatan' => $jabatan->name,
            // 'divisi' => $request['divisi'],
            'pendidikan' => json_encode($pendidikan),
            'n_ibu_kandung' => $request['nama_ibu'],
            'suku' => $request['suku'],
            's_keluraga_orangtua' => json_encode($keluarga_orangatua),
            's_keluarga_sendiri' => json_encode($susunan_keluarga_sendiri),
            // 'sosmed' => json_encode($sosmed),
            'p_kerja' => json_encode($p_kerja),
            'agama' => $request['agama'],
            'status_pernikahan' => $request['status_pernikahan'],
            'kewarganegaraan' => $request['kewarganegaraan'],
            'golongan_darah' => $request['darah'],
            // 'ec_families'=>$request['ec_families'],
            // 'graduated_from'=>$request['graduated_from'],
            'password' => $request['idSSS'],
        ];
        // dd($data);

        $user = User::create($data);

        $roles = $request['jabatan'];
        if(isset($roles)){
            $role_r = Role::where('id', '=', $roles)->firstOrFail();
            $user->assignRole($role_r); //Assigning role to user
        }

        return $user;
    }


    public function updateUser(Request $request){ //perlu di update ini
        // dd($request);
        $getDataUser = User::where('employee_id',$request->id_user)->get();
        // dd($getDataUser);
        // die();
        $validator = Validator::make($request->all(), [
            'ktp' => 'required|string|min:8|unique:users',
            'kk' => 'string|nullable',
            'fullname'=>'required|string|max:255|min:3',
            'email' =>'required|string|email|max:255|min:3|unique:users',
            'passport' =>'string|nullable',
            'password'=>'required|min:6|confirmed',
            // 'sosmed'=>'string|nullable',
            // 'ec_families'=>'string|nullable',
            //json format graduated_from graduated_from:{SD:{'nama':'','jurusan':'','program':'',....}} for future use.
            // 'graduated_from'=>'string|nullable',

        ]);
        $jabatan = Role::find($request['jabatan']);
        $data = [
            // 'employee_id' => $idUser,
            'fullname' => ($request['fullname'] !== null) ? $request['fullname'] : $getDataUser[0]->fullname,
            'email' => ($request['email'] !== null) ? $request['email'] : $getDataUser[0]->email,
            'tlp_hp' => ($request['phone_hp'] !== null) ? $request['phone_hp'] : $getDataUser[0]->tlp_hp,
            'tlp_rumah' => ($request['phone_rumah'] !== null) ? $request['phone_rumah'] : $getDataUser[0]->tlp_rumah,
            'passport' => ($request['passport'] !== null) ?$request['passport'] : $getDataUser[0]->passport,
            'ktp' => ($request['ktp'] !== null) ?$request['ktp'] : $getDataUser[0]->ktp,
            'kk' => ($request['kk'] !== null) ?$request['kk'] : $getDataUser[0]->kk,
            'npwp' => ($request['npwp'] !== null) ?$request['npwp'] : $getDataUser[0]->npwp,
            'jabatan' => ($request['jabatan'] !== null) ? $jabatan->name : $getDataUser[0]->jabatan,
            'almt_ktp' => ($request['alamat_ktp'] !== null) ?$request['alamat_ktp'] : $getDataUser[0]->almt_ktp,
            'status_pernikahan' => ($request['status_pernikahan'] !== null) ?$request['status_pernikahan'] : $getDataUser[0]->status_pernikahan,
            'agama' => ($request['agama'] !== null) ?$request['agama'] : $getDataUser[0]->agama,
            'kewarganegaraan' => ($request['kewarganegaraan'] !== null) ?$request['kewarganegaraan'] : $getDataUser[0]->kewarganegaraan,
            'golongan_darah' => ($request['darah'] !== null) ?$request['darah'] : $getDataUser[0]->golongan_darah,
            'almt_domisili' => ($request['alamat_domisili'] !== null) ?$request['alamat_domisili'] : $getDataUser[0]->almt_domisili,
            'password' => ($request['password'] !== null) ?$request['password'] : $getDataUser[0]->password,
        ];
        $getDataUser[0]->update($data);
        return $getDataUser;
    }

    public function reset_password_id(Request $request){
        return view('admin.profile.resetPassword');
    }

    public function sendIDKarayawan(Request $request){
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required|string|min:4',
        ]);
        $getDataUser = User::where('employee_id',$request->id_karyawan)->get();
        $getDataUser[0]->update(['password'=>$getDataUser[0]->employee_id]);
        // dd(Hash::make($getDataUser[0]->employee_id));
        return redirect()->back()->with('successResetPWD', 'Berhasil Reset Password Karyawan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
