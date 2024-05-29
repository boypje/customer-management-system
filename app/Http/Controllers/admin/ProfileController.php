<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Salary;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProfileController extends Controller
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
    public function index()
    {
        //
    }

    public function viewProfileById($id){
        if(Auth::user()->id == $id){
            $dataUserById = User::where('id',$id)->get();
            $ec1 = json_decode($dataUserById[0]->ec1);
            $ec2 = json_decode($dataUserById[0]->ec2);
            $pendidikan = $dataUserById[0]->pendidikan;
            // dd($pendidikan['sekolah1']);
            // User::find($id)->roles->pluck('name') check user punya 2 role (type datanya array)
            // dd(User::find($id)->roles->pluck('name'));
            // $role = User::find($id)->roles->pluck('name');
            // User::find($id)->hasRole('Skiptrace') // cek apakah role tsb true atau ada
            // User::find($id)->removeRole('Skiptrace')// delete role by name
            // $role = Role::findByName('Skiptrace');

            // $role->revokePermissionTo('View Skiptrace');
            // $user = User::find($id);

            // $user->revokePermissionTo('View Skiptrace');
            // dd(User::find($id)->removeRole('Skiptrace'));
            return view('admin.profile.index',['dataUser'=>$dataUserById,'ec1'=>$ec1,'ec2'=>$ec2,'pendidikan'=>$pendidikan]);
        }else{
            return redirect()->route('admin');
        }
    }

    public function editPasswordProfile(Request $request){
        // $2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO
        $dataUser = User::find($request->user_id);
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|min:3',
            'ktp'=>'required',
            'kk'=>'required',
            'alamat_ktp'=>'required',
            'alamat_domisili'=>'required',
            'no_hp' =>'required|string',
            'no_telp' =>'required|string',
            'nama_ibu' =>'required|string',
            'ec1' =>'required|string',
            'ec2' =>'required|string',
            'email' =>'required|string|email|max:255|min:3|unique:users',
            'tempat_lahir'=>'required',
            'file_cv' => 'required|max:5024',
            'file_ktp' => 'required|max:1024',
            'file_ijazah' => 'required|max:1024',
            'file_foto' => 'required|max:1024',
            'file_kk' => 'required|max:1024',
        ]);

        // pendidikan
        $pendidikan1 = [
            'thn_masuk1' => null,
            'thn_keluar1' => null,
            'nama1' => $request->sekolah1,
            'nama_jurusan1' => $request->jurusan1,
            'jenjang1' => $request->pendidikan_1
        ];
        $pendidikan2 = [
            'thn_masuk2' => null,
            'thn_keluar2' => null,
            'nama2' => $request->sekolah2,
            'nama_jurusan2' => $request->jurusan2,
            'jenjang2' => $request->pendidikan_2
        ];
        $pendidikan3 = [
            'thn_masuk3' => $request->tahun_masuk3,
            'thn_keluar3' => $request->tahun_keluar3,
            'nama3' => $request->sekolah3,
            'nama_jurusan3' => $request->jurusan3,
            'jenjang3' => $request->pendidikan_3
        ];
        $pendidikan = [
            'sekolah1' => $pendidikan1,
            'sekolah2' => $pendidikan2,
            'sekolah3' => $pendidikan3
        ];
        $pengalaman1 = [
            'tgl_msk1' => $request->tanggal_masukkerja1,
            'tgl_klr1' => $request->tanggal_keluarkerja1,
            'nama1' => $request->perusahaan1,
            'jbtn1' => $request->jabatan1,
            'salary_tkhr1' => $request->gaji_terakhir1
        ];
        $pengalaman2 = [
            'tgl_msk2' => $request->tanggal_masukkerja2,
            'tgl_klr2' => $request->tanggal_keluarkerja2,
            'nama2' => $request->perusahaan2,
            'jbtn2' => $request->jabatan2,
            'salary_tkhr2' => $request->gaji_terakhir2
        ];
        $pengalaman_kerja = [
            'pengalaman1' => $pengalaman1,
            'pengalaman2' => $pengalaman2,
        ];
        // emegency kontak
        $ec1 = [
            'nomor_ec1' => $request->no_ec2,
            'nama_ec1' => $request->nama_ec1 ,
            'hub_ec1' => $request->hub_ec1 ,
        ];
        $ec2 = [
            'nomor_ec2' => $request->no_ec2,
            'nama_ec2' => $request->nama_ec2,
            'hub_ec2' => $request->hub_ec2
        ];

        if($dataUser->resume == ''){
            // file_cv
            $file_cv = request()->file('file_cv');
            $extn_cv = $file_cv->getClientOriginalExtension(); //get extension file
            $file_cv->move("file_upload/".$dataUser->employee_id, 'CV-'.date('dmY').'.'.$extn_cv); //moving file to directory
            $path_cv = 'CV-'.date('dmY').'.'.$extn_cv;
            // file_foto_diri
            $file_f_diri = request()->file('file_foto');
            $extn_f_diri = $file_f_diri->getClientOriginalExtension(); //get extension file
            $file_f_diri->move("file_upload/".$dataUser->employee_id, 'Foto-'.date('dmY').'.'.$extn_f_diri); //moving file to directory
            $path_f_diri = 'Foto-'.date('dmY').'.'.$extn_f_diri;
            // file_ktp
            $file_ktp = request()->file('file_ktp');
            $extn_ktp = $file_ktp->getClientOriginalExtension(); //get extension file
            $file_ktp->move("file_upload/".$dataUser->employee_id, 'KTP-'.date('dmY').'.'.$extn_ktp); //moving file to directory
            $path_ktp = 'KTP-'.date('dmY').'.'.$extn_ktp;
            // file_ijazah
            $file_ijazah = request()->file('file_ijazah');
            $extn_ijazah = $file_ijazah->getClientOriginalExtension(); //get extension file
            $file_ijazah->move("file_upload/".$dataUser->employee_id, 'Ijazah-'.date('dmY').'.'.$extn_ijazah); //moving file to directory
            $path_ijazah = 'Ijazah-'.date('dmY').'.'.$extn_ijazah;
            // file_kk
            $file_kk = request()->file('file_kk');
            $extn_kk = $file_kk->getClientOriginalExtension(); //get extension file
            $file_kk->move("file_upload/".$dataUser->employee_id, 'KK-'.date('dmY').'.'.$extn_kk); //moving file to directory
            $path_kk = 'KK-'.date('dmY').'.'.$extn_kk;
        }

        $date = str_replace('/', '-', $request->tanggal_lahir);
        if($dataUser->resume != ''){
            $updateProfile = [
                'fullname'=> $request->name,
                'ktp'=> $request->ktp,
                'kk'=> $request->kk,
                'almt_ktp'=> $request->alamat_ktp,
                'almt_domisili'=> $request->alamat_domisili,
                'tlp_hp' => $request->no_hp,
                'n_ibu_kandung'=>$request->nama_ibu,
                'golongan_darah' => $request->golongan_darah,
                'suku' => $request->suku,
                'kewarganegaraan' => $request->kewarganegaraan,
                'agama' => $request->agama,
                'ec1'=>json_encode($ec1),
                'ec2'=>json_encode($ec2),
                'tlp_rumah' => $request->no_telp,
                'email' => $request->email,
                'tempat_lahir'=> $request->tempat_lahir,
                'tanggal_lahir'=> date('Y-m-d', strtotime($date)),
                // 'resume' => $path_cv,
                // 'f_diri' => $path_f_diri,
                // 'f_kk' => $path_kk,
                // 'f_ktp' => $path_ktp,
                // 'f_ijazah' => $path_ijazah,
                'pendidikan' => json_encode($pendidikan),
                'p_kerja' => json_encode($pengalaman_kerja),
            ];
        }else{
            $updateProfile = [
                'fullname'=> $request->name,
                'ktp'=> $request->ktp,
                'kk'=> $request->kk,
                'almt_ktp'=> $request->alamat_ktp,
                'almt_domisili'=> $request->alamat_domisili,
                'tlp_hp' => $request->no_hp,
                'n_ibu_kandung'=>$request->nama_ibu,
                'golongan_darah' => $request->golongan_darah,
                'suku' => $request->suku,
                'kewarganegaraan' => $request->kewarganegaraan,
                'agama' => $request->agama,
                'ec1'=>json_encode($ec1),
                'ec2'=>json_encode($ec2),
                'tlp_rumah' => $request->no_telp,
                'email' => $request->email,
                'tempat_lahir'=> $request->tempat_lahir,
                'tanggal_lahir'=> date('Y-m-d', strtotime($date)),
                'resume' => $path_cv,
                'f_diri' => $path_f_diri,
                'f_kk' => $path_kk,
                'f_ktp' => $path_ktp,
                'f_ijazah' => $path_ijazah,
                'pendidikan' => json_encode($pendidikan),
                'p_kerja' => json_encode($pengalaman_kerja),
            ];
        }

        $user = User::find($request->user_id);
        $user->update($updateProfile);
        // dd($updateProfile);
        // die();
        // return 'success';
        return redirect()->route('admin');
    }

    public function viewChangePassword($id){
        $user = User::findOrFail($id);

        // Check if the authenticated user matches the user from the URL
        if (Auth::user()->id !== $user->id) {
            // User is not authorized to change this password
            abort(403, 'Sorry you cannot doing that action.');
        }
        $dataUser = User::where('id',$id)->get();
        // dd();
        return view('admin.profile.formPassword',['dataUser'=>$dataUser]);
    }

    public function editPassword(Request $request){
        // dd(Hash::make('ID-SSS50556'));
        // $2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO   pwd super
        $this->validate($request, [
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'confirm_password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'
        ]);

        $dataUser = User::find($request->user_id);
        $check_pwd_same = str_contains($request->password, $request->confirm_password);
        if($check_pwd_same == true){
            $dataUser->update(['password'=>$request->password]);
            return redirect()->route('admin')->with('SuccessChangePwd', 'Password Anda Telah Berhasil diubah');
            // dd('true');
        }else{
            // dd('false');
            return redirect()->back()->with('FailedChangePwd', 'Password yang Anda Masukkan Tidak Cocok Silahkan Coba Kembali');
        }

        // dd($request);
    }

    public function getDataSalaryUserById($id){
        // dd($id);
        $getDataUserById = User::FindOrFail($id);
        $data = Salary::where('employee_id',$getDataUserById->employee_id)->get();
        // dd($getDataSalaryById);
        return Datatables::of($data)
            ->addIndexColumn()
                ->addColumn('Nama', function($data){
                    foreach(User::where('employee_id','=', $data->employee_id)->get() as $user){
                        return $user->full_name;
                    }
                })
                ->addColumn('pendapatan', function($data){
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->insentif + $data->attending + $data->rapel + $data->bonus;
                    $convrtPendapatan = "Rp " . str_replace(",00","",number_format($pendapatan,2,',','.'));
                    return $convrtPendapatan;
                })
                ->addColumn('periode', function($data){

                    // dd();
                    return date("F Y", strtotime($data->salary_periode));
                })
                ->addColumn('potongan', function($data){
                    $potongan = $data->late_reduce + $data->permit_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21;
                    $convrtPotongan = "Rp " . str_replace(",00","",number_format($potongan,2,',','.'));
                    return $convrtPotongan;
                })
                ->addColumn('total', function($data){
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->insentif + $data->attending + $data->rapel + $data->bonus;
                    $potongan = $data->late_reduce + $data->permit_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21 ;
                    $total = $pendapatan - $potongan;
                    $convrtTotal = "Rp " . str_replace(",00","",number_format($total,2,',','.'));
                    return $convrtTotal;
                })
                ->addColumn('action', function($user){
                    $button = '<a href="'.route('viewSlipSalary',$user->id).'" data-toggle="tooltip" title="Lihat Slip Salary" class="btn btn-outline-info btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    return $button;
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
