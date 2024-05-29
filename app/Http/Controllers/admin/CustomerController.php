<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Customer;
use App\models\Platform;
use Yajra\DataTables\DataTables;
use App\Imports\CustomerImport;
use App\models\Temporary;
use App\models\CustomerContact;
use Maatwebsite\Excel\Facades\Excel;
use App\models\CustomerDetails;
use App\models\CustomerSosmeds;
use App\models\UsersTransaction;
use Illuminate\Support\Facades\Auth;
use App\models\OwnerData;
use App\models\Remark;
use App\models\Payments;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\Console\Input\Input;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use App\Common;
use Illuminate\Support\Facades\Validator;
use Exception;

class CustomerController extends Controller
{
    public function index(Request $request){
        $kode = Common::cleanInput($request->kode);
        $nama = Common::cleanInput($request->nama);
        $phone = Common::cleanInput($request->phone);
        $email = Common::cleanInput($request->email);
        $dataPlatform = Platform::all();

        $data = Customer::select(
            'customer.user_id',
            'customer.ktp',
            'customer.id',
            'customer.customer_id',
            'customer.email',
            'customer.nama_customer',
            'customer.phone',
            'customer.nominal',
            'customer.others',
            'customer.updated_at',
            DB::raw('MAX(remark.created_at) as latest_remark_date')
        )
        ->leftJoin('remark', 'customer.id', '=', 'remark.customer_id')
        ->where('data_status', '=', 'aktif')
        ->groupBy(
            'customer.user_id',
            'customer.ktp',
            'customer.id',
            'customer.customer_id',
            'customer.email',
            'customer.nama_customer',
            'customer.phone',
            'customer.nominal',
            'customer.others',
            'customer.updated_at'
        )->orderBy(DB::raw('COALESCE(MAX(remark.created_at), customer.updated_at)'), 'asc');
        
        if (auth()->user()->jabatan == 'Desk Collection') {
            // $data = $data->whereJsonContains('customer.user_id', '=', (string) auth()->user()->id);
            $data = $data->where('customer.user_id', '=', auth()->user()->id);
        }

            //Record log search transaction to DB
            $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');
            $record_create = [
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' =>'Searching customer',
                    'transaction_val' =>'Keyword : '.$kode.','.$nama.','.$phone.','.$email.' by auth user '. User::find(auth()->user()->id)->fullname,
                    'date_upload'=>$dateUpload
                ];
            $record_save = UsersTransaction::create($record_create);  
      
        return view('admin.customer.index',['platform'=>$dataPlatform,'dataTB'=>$data->sortable()->paginate(25)]);
    }

    public function formCustomer(){
        $dataPlatform = Platform::all();
        return view('admin.customer.form',['platform'=>$dataPlatform]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_customer' => 'required|min:3',
            'ktp' => 'required|min:10|max:16',
            'nomor_kontak' => 'required|min:10|max:13',
            'nomor_kontak2' => 'required|min:10|max:13',
            'email' => 'required|email|max:255|min:3|',
            'alamat' => 'required',
            'platform' => 'required',
            'hubungan_kontak' => 'required',
            'nama_kontak' => 'required|min:3',
        ]);

        if ($validator->fails()){
            return $validator->errors();
        }

        $data = [
            'id_customer'=> Common::cleanInput($request->id_customer),
            'nama_customer' => Common::cleanInput($request['nama_customer']),
            'ktp' => Common::cleanInput($request['ktp']),
            'nominal'=> Common::cleanInput($request->nominal),
            'email' => Common::cleanInput($request->email),
            'address' => Common::cleanInput($request->alamat),
            'platform' => Common::cleanInput($request->platform)
        ];

        $user = Customer::create($data);
        $type_kontak = '';
        ($request->jenisKontak == 'ec') ? $type_kontak = 'kontak darurat' : $type_kontak = 'kantor';
        if($user->id != null){
            $data_contact = [
                'customer_id'=> $user->id,
                'number_contact'=> Common::cleanInput($request->nomor_kontak),
                'contact_name'=> Common::cleanInput($request->nama_kontak),
                'hubungan_ec'=> Common::cleanInput($request->hubungan_kontak),
                'type_contact'=> Common::cleanInput($type_kontak),
                'address' => Common::cleanInput($request->alamat_kontak)
            ];
            $contact = CustomerContact::create($data_contact);

            $data_sosmed = [
                'customer_id'=>$user->id,
                'fb'=>$request->fb,
                'tw'=>$request->twitter,
                'ig'=>$request->ig,
            ];
            $sosmed = CustomerSosmeds::create($data_sosmed);

            // record create user
            $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');
            $record_create = [
                'uid' => Auth::user()->id, //id user yang login
                'transaction_type' =>'created customer',
                'transaction_val' =>'inserting data customer',
                'date_upload'=>$dateUpload
            ];
            $record_save = UsersTransaction::create($record_create);

            // create relasion owner data
            $ownData = [
                'uid'=>Auth::user()->id,
                'cid'=>$user->id
            ];
            $saveOwnData = OwnerData::create($ownData);
            // end record
        }
        return redirect()->back()->with('SuccessInsertData', 'Data berhasil di tambahkan ke Database');
    }

    // insert user by upload excel and save file excel in public file/DataKaryawan
    public function uploadDataCustomer(Request $request){
        
        $validator = Validator::make($request->all(),[
            'tanggal_awal' => 'required|date_format:yy/mm/dd',
            'tanggal_akhir' =>'required|date_format:yy/mm/dd',
            'file_excel_customer'=>'required|max:10000|mimes:xlsx,xls'
        ]);

        if ($request->tanggal_awal >= $request->tanggal_akhir && $validator->fails()){
            return redirect()->back()->with('ErrorImportExcel', 'Import Gagal! Silahkan cek kembali periode awal, periode akhir, dan excel anda! ');
        }
        Customer::where('platform', $request->platform)->update(['data_status' => 'tidak_aktif']);
        $users = (new FastExcel)->import($request->file('file_excel_customer'), function ($line) use ($request){
            // $user_id = (isset($line['owner_data']) || !empty($line['owner_data'])) ? User::where('employee_id',$line['owner_data'])->get() : null;
            $user_id = [
                (string) $line['owner_data'],
                (string) $line['owner_data2']
            ];
            $cek_customer = Customer::where('customer_id','=',$line['kontrak_id']);
            $id_cus = ($cek_customer->get()->isEmpty()) ? null : $cek_customer->get()[0]->id;
            $getLastCustomerId = Customer::select('customer_id')->orderBy('id', 'desc')->first();
            $dateUpload = \Carbon\Carbon::now();
            
            try {
                
                $contacts = [$line['phone1'],$line['phone2'],$line['no_kantor'],$line['no_ec']];
                $contacts_name = [$line['nama_lengkap'],$line['nama_lengkap'],$line['nama_kantor'],$line['nama_ec']];
                $contacts_hub = ['self','self2','kantor',$line['hubungan_ec']];
                $contacts_addr = [$line['alamat'],$line['alamat'],$line['alamat_kantor'],$line['alamat_ec']];
                
                $customer_save = Customer::updateOrCreate([
                    'id' => ($cek_customer->get()->isEmpty()) ? $getLastCustomerId->customer_id : $cek_customer->get()[0]->id,
                ], [
                    'customer_id' => $line['kontrak_id'],
                    // 'user_id' => $user_id[0]->id,
                    'user_id' => json_encode((object) $user_id), // Convert to object before encoding to JSON
                    'nama_customer' => $line['nama_lengkap'],
                    'ktp' => $line['ktp'],
                    'email' => $line['email'],
                    'address' => $line['alamat'],
                    'platform' => $request['platform'],
                    'phone' => $line['phone1'], //no customer
                    'nominal' => $line['nominal'],
                    'dpd' => $line['dpd'],
                    'data_status' => 'aktif', // Set 'data_status' to 'aktif'
                    'periode_start' => $request->tanggal_awal,
                    'periode_end' => $request->tanggal_akhir,
                    'others' => json_encode($line),
                    'date_uploaded' => $dateUpload->format('Y-m-d')
                ]);
                return redirect()->back()->with('SuccessImportExcel', 'Data berhasil di tambahkan ke Database');
            } catch (\Exception /*\Throwable*/ $e) //error akan berjalan jika header tidak ada pada excel
            {
                $cus_data[] = $e->getMessage(); //get return customer value
                $message = $e->getMessage();
                // dd($message);
                return back()->withError($message)->withInput();
            }
        });

        $dateUpload = \Carbon\Carbon::now();
        UsersTransaction::Create([
            'uid'=>Auth::user()->id,
            'transaction_type'=> 'Import',
            'transaction_val'=> 'Importing data Customer by '.auth()->user()->fullname,
            'date_upload'=>$dateUpload->format('d-m-Y H:m')
        ]);

        // return response()->json(['success'=>'Data Success Import.']);
        // Excel::import(new CustomerImport,  $request->file('file_excel_customer')); //fungsi membaca importnya
        return redirect()->back();
    }

     //download tamplate excel user
     public function getTamplateExcelCustomer(){
        $filepath = storage_path('format_data_customer/data_customer.xlsx');
        if (file_exists($filepath)) {
            return Response()->download($filepath);
        }
    }

    public function updateDataContactcustomer(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'number_contact' =>'required',
            'contact_name' => 'required',
            'address' => 'required',
            'type_contact' => 'required',
        ]);
        $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');


        // insert bedasarkan total array
        $totalArray = count($request->namaKontak);
        for($i = 0 ; $i < $totalArray ; $i++){

            if($totalArray == 1){

                $data = [
                    'customer_id' => $request->id,
                    'number_contact' => Common::cleanInput($request->nomorKontak[$i]),
                    'contact_name' => Common::cleanInput($request->namaKontak[$i]),
                    'hubungan_ec'=> Common::cleanInput($request->type_contact[$i]),
                    'address' => Common::cleanInput($request->type_contact[$i]),
                    'type_contact' => null,
                ];

                $updatePhone = CustomerContact::create($data);


                $record_update_phone = [
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' =>'update customer kontak',
                    'transaction_val' =>'update data kontak id '.$updatePhone->id,
                    'date_upload'=>$dateUpload
                ];
                $record_save = UsersTransaction::create($record_update_phone);
            }else{
                $updatePhone = CustomerContact::create([
                    'customer_id' => $request->id,
                    'number_contact' => Common::cleanInput($request->nomorKontak[$i]),
                    'contact_name' => Common::cleanInput($request->namaKontak[$i]),
                    'hubungan_ec'=> Common::cleanInput($request->type_contact[$i]),
                    'address' => Common::cleanInput($request->type_contact[$i]),
                    'type_contact' => null,
                ]);
                

                $record_save = UsersTransaction::create([
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' =>'update customer kontak',
                    'transaction_val' =>'update data kontak dengan no '.$updatePhone->number_contact,
                    'date_upload'=>$dateUpload
                ]);
            }
        }
        return redirect()->back()->with('SuccessUpdataDataCustomer', 'Data berhasil di tambahkan ke Database');
    }

    public function updateDataSosmedcustomer(Request $request){
        $validator = Validator::make($request->all(), [
            'idCustomers' => 'required',
            'fb' =>'required',
            'tw' => 'required',
            'ig' => 'required',
            'oth' => 'required',
        ]);
        $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');

        $totalArray = count($request->fb);
        
        for($i = 0 ; $i < $totalArray ; $i++){
            if($totalArray == 1){
                $data = [
                    'customer_id' => $request->id,
                    'fb' => Common::cleanInput($request->fb[$i]),
                    'tw' => Common::cleanInput($request->tw[$i]),
                    'ig' => Common::cleanInput($request->ig[$i]),
                    'oth' => Common::cleanInput($request->oth[$i]),
                ];

                $updateSosmed = CustomerSosmeds::create($data);

                $record_update_sosmed = [
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' =>'update customer sosmed',
                    'transaction_val' =>'update data sosmed ',
                    'date_upload'=>$dateUpload
                ];
                $record_save = UsersTransaction::create($record_update_sosmed);
            }else{
                $updateSosmed = CustomerSosmeds::create([
                    'customer_id' => $request->id,
                    'fb' => Common::cleanInput($request->fb[$i]),
                    'tw' => Common::cleanInput($request->tw[$i]),
                    'ig' => Common::cleanInput($request->ig[$i]),
                    'oth' => Common::cleanInput($request->oth[$i])
                ]);

                $record_save = UsersTransaction::create([
                    'uid' => Auth::user()->id, //id user yang login
                    'transaction_type' =>'update customer sosmed',
                    'transaction_val' =>'update data sosmed ',
                    'date_upload'=>$dateUpload
                ]);
            }
        }
        return redirect()->back()->with('SuccessUpdataDataCustomer', 'Data berhasil di tambahkan ke Database');
    }

    public function viewEditCustomer($id){
        return view('admin.Customer.editCustomerData',['id'=>$id]);
    }

    public function editDataCustomerById($id){
        $getDataCustomer = Customer::FindOrFail($id);
        return $getDataCustomer;
    }

    public function viewDataCustomer($id){
        $dataCustomer = Customer::where('id',$id)->select('customer.ktp', 'nama_customer','email','id','nama_customer','platform','address','nominal','customer.id as id','customer.email', 'customer.others')->get();
        // DB::raw("concat('Rp.', format(nominal,2)) as nominal")
        $platform = Platform::Find($dataCustomer[0]->platform);
        $payment = Payments::where('customer_id',$id)->where('category_payment','partial_payment')->select('nominal')->get();
        // dd($payment);

            $data = [
                'Customer' => $dataCustomer[0],
                'platform'=> json_decode($platform)->nama,
                'payment'=>$payment
            ];
            // return $data;

        return view('admin.customer.viewDataCustomer', compact('data'));
    }

    public function getDataCustomer($id){
        // $dataCustomer = Customer::find($id);
        $dataCustomer = Customer::where('id',$id)->select('customer.ktp', 'nama_customer','email','id','nama_customer','platform','address',DB::raw("concat('Rp.', format(nominal,2)) as nominal"),'customer.id as id','customer.email')->get();
        $platform = Platform::Find($dataCustomer[0]->platform);

            $data = [
                'Customer' => $dataCustomer[0],
                'platform'=> Common::cleanInput($platform)
            ];
            return $data;
    }

    public function getDataContact($id){
        $dataCustomer = Customer::find($id);
        $contact = CustomerContact::where('customer_id',$dataCustomer->id)->get();
        $tb = Datatables::of($contact)
        ->addIndexColumn()
                ->addColumn('nama', function($data){
                    return $data->contact_name;
                })
                ->addColumn('nomor_kontak', function($data){
                    // $maskedPhone = substr($data->number_contact, 0, 4) . "*****" . substr($data->number_contact, 7, 4);
                    // return $maskedPhone;
                    $link = $data->number_contact;
                    return $link;
                })
                ->addColumn('type', function($data){
                    return $data->hubungan_ec;
                })
                ->addColumn('date', function($data){
                    return $data->created_at->format('d-m-Y');
                })
                ->addColumn('action', function($data){
                    $button = '';
                    // $button .= '<a href="#" onclick="update_data_kontak('.$data->id.')" data-toggle="tooltip" title="Ubah Data kontak" class="btn btn-outline-success btn-sm"><i class="ni ni-ruler-pencil"></i></a>';
                    $button .= '<a href="sip:'.$data->number_contact.'" data-toggle="tooltip" title="Telfon Customer" class="btn btn-outline-primary btn-sm"><i class="fas fa-phone-volume"></i></a>';
                    return $button;
                })->make(true);
        return $tb;
    }

    public function getDataSosmed($id){
        $dataCustomer = Customer::find($id);
        $sosmed = CustomerSosmeds::where('customer_id',$dataCustomer->id)->get();
        $tb = Datatables::of($sosmed)
        ->addIndexColumn()
                ->addColumn('fb', function($data){
                    return $data->fb;
                })
                ->addColumn('tw', function($data){
                    return $data->tw;
                })
                ->addColumn('type', function($data){
                    return $data->type_contact;
                })
                ->addColumn('ig', function($data){
                    return $data->ig;
                })
                ->addColumn('action', function($data){
                    $button = '';
                    $button = '<a href="#" onclick="update_data_sosmed('.$data->id.')"  data-toggle="tooltip" title="Ubah Data Sosmed" class="btn btn-outline-success btn-sm"><i class="ni ni-ruler-pencil"></i></a>';
                    return $button;
                })->make(true);
        return $tb;
    }

    public function getContactForEdited($id){
        $phoneCustomer = CustomerContact::find($id);
        // dd($phoneCustomer);
        return $phoneCustomer;

    }

    public function getSosmedForEdited($id){
        $sosmedCustomer = CustomerSosmeds::FindOrFail($id);
        return $sosmedCustomer;
    }

    public function editDataKontak(Request $request){
        $dataKontak = CustomerContact::find($request->id);
        $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');
        $data = [
            'number_contact'=>Common::cleanInput($request->nomor_kontak),
            'contact_name'=>Common::cleanInput($request->nama_kontak),
            'type_contact'=>Common::cleanInput($request->tipe_kontak),
            'hubungan_ec'=>Common::cleanInput($request->tipe_kontak),
            'address'=>Common::cleanInput($request->alamat_kontak),
        ];

        $record_save = UsersTransaction::create([
            'uid' => Auth::user()->id, //id user yang login
            'transaction_type' =>'update customer sosmed',
            'transaction_val' =>'update data kontak customer name is '.$dataKontak->contact_name,
            'date_upload'=>$dateUpload
        ]);

        $dataKontak->update($data);
        return redirect()->back()->with('SuccessUpdataDataCustomer', 'Data Kontak berhasil di ubah ke Database');
    }

    public function editDataSosmed(Request $request){
        $dataSosmed = CustomerSosmeds::find($request->id);
        $dateUpload = \Carbon\Carbon::now()->format('d-m-Y H:m');

        $data = [
            'fb'=> Common::cleanInput($request->fb),
            'tw'=> Common::cleanInput($request->tw),
            'ig'=> Common::cleanInput($request->ig),
            'other'=> Common::cleanInput($request->other),
        ];
        $record_save = UsersTransaction::create([
            'uid' => Auth::user()->id, //id user yang login
            'transaction_type' =>'update customer sosmed',
            'transaction_val' =>'update data sosmed customer sosmed',
            'date_upload'=>$dateUpload
        ]);

        $dataSosmed->update($data);
        return redirect()->back()->with('SuccessUpdataDataCustomer', 'Data Sosmed berhasil di ubah ke Database');
    }

    public function updateDPD(Request $request){
        // Get the current date
        $currentDate = now()->toDateString(); // Dapatkan tanggal saat ini

        // Periksa apakah ada entri yang sudah ada dalam tabel Temporary
        $temporaryRecord = Temporary::first();
        
        if ($temporaryRecord) {
            // Jika entri sudah ada, perbarui statusnya jika diperlukan
            if ($temporaryRecord->date == $currentDate && $temporaryRecord->status == 0) {
                // jika status 0
                $temporaryRecord->update([
                    'status' => 1,
                ]);
                
            } 
            
            if($temporaryRecord->date != $currentDate){
                // jika status 1
                $temporaryRecord->update([
                    'date' => $currentDate,
                ]);

                DB::table('customer')
                ->where('data_status', 'aktif')
                ->update(['dpd' => DB::raw('dpd + ' . $request->increaseDay)]);
            }
        } else {
            // Jika tidak ada entri, buat entri baru
            Temporary::create([
                'date' => $currentDate,
                'status' => 0,
            ]);
        }

        // $affectedRows will contain the number of rows affected by the update
        return response()->json(['message' => 'Status updated successfully', 'Successfully Updated' => $temporaryRecord->date == $currentDate && $temporaryRecord->status == 0]);
    }

    
    

}
