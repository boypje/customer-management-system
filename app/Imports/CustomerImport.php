<?php

namespace App\Imports;

use App\models\Customer;
use App\models\CustomerContact;
use App\models\CustomerSosmeds;
use App\models\Platform;
use App\models\UsersTransaction;
use App\models\OwnerData;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithChunkReading;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
// use Maatwebsite\Excel\Validators\Failure;


class CustomerImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $arrRows = [
            'customer_id',
            'nama_lengkap',
            'ktp',
            "email",
            "phone1",
            "phone2",
            "no_ec",
            "nama_ec",
            "alamat_ec",
            "hubungan_ec",
            "nama_kantor",
            "no_kantor",
            "alamat_kantor",
            "fb",
            "tw",
            "ig",
            "other",
            "alamat",
            "nominal",
            "owner_data",
            "no_ec2",
            "nama_ec2",
            "alamat_ec2",
            "hubungan_ec2",
            "no_ec3",
            "nama_ec3",
            "alamat_ec3",
            "hubungan_ec3",
            "no_ec4",
            "nama_ec4",
            "alamat_ec4",
            "hubungan_ec4"
        ]; //list array yang ada di excel

        // array_pop($row); //menghapus last index yang null

        $countRow = count($row); // menghitung jumlah header dari excel menjadi array
        $countRequireRow = count($arrRows); // mengitung jumlah list data yang dibutuhkan di tb customer, customer contact, customer sosmed
        $i =$countRequireRow; // menghitung jumlah data yang melebihi kebutuhan tb customer
        // array_slice($row, -$i, $i, true)  // mengabil array yang tidak terlist oleh excel
        $dateUpload = \Carbon\Carbon::now();
        $otherData = array_slice($row, -$i, $i, true); //menggabungkan array yang tidak ter-list dalam sistem
        $request = request()->all();
        $user_id = User::where('employee_id',$row['owner_data'])->get('id');
        $cek_customer = Customer::where('customer_id','=',$row['id_customer']);
        $cus_contacts = CustomerContact::where('customer_id', ($cek_customer->get()->isEmpty()) ? null : $cek_customer->pluck('id'));
        // $nama_platform = Platform::find($request['platform']);
        // dd($cus_contact);
        

        $customer_save = Customer::updateOrCreate([
            'id' => ($cek_customer->get()->isEmpty()) ? null : $cek_customer->get()[0]->id,
        ],[
            'customer_id'=>$row['id_customer'], //id customer dari platform
            'user_id'=>$user_id[0]->id,
            'nama_customer' => $row['nama_lengkap'],
            'ktp' => $row['ktp'],
            'email' => $row['email'],
            'address' => $row['alamat'],
            'platform' => $request['platform'],
            'nominal' => $row['nominal'],
            // 'periode_start' => $request->periode_start,
            // 'periode_end' => $request->periode_end,
            'others' => json_encode($otherData),
            'date_uploaded' => $dateUpload->format('Y-m-d')
        ]);
        
        // dd(array_search($contacts,$cus_contacts));

        //contact wrapper
        $contacts = [$row['phone1'],$row['phone2'],$row['no_kantor'],$row['no_ec'],$row['no_ec2'],$row['no_ec3'],$row['no_ec4']];
        $contacts_name = [$row['nama_lengkap'],$row['nama_lengkap'],$row['nama_ec'],$row['nama_kantor'],$row['nama_ec2'],$row['nama_ec3'],$row['nama_ec4']];
        $contacts_hub = ['self','self2','kantor',$row['hubungan_ec'],$row['hubungan_ec2'],$row['hubungan_ec3'],$row['hubungan_ec4']];
        $contacts_addr = [$row['alamat'],$row['alamat'],$row['alamat_kantor'],$row['alamat_ec'],$row['alamat_ec2'],$row['alamat_ec3'],$row['alamat_ec4']];
        
        $id_cus = ($cus_contacts->pluck('id') != null) ? null : $cus_contacts->pluck('id') ;
        foreach($contacts as $contact_key => $contact_value){
            if($contact_value != null && (($cus_contacts->get()->isEmpty()) ? null : $cus_contacts->get()[0]->number_contact) == null){
                CustomerContact::updateOrCreate([
                    'id' => $id_cus,
                ],[
                    'customer_id'=>$customer_save->id,
                    'number_contact'=>$contact_value,
                    'contact_name'=>$contacts_name[$contact_key],
                    'hubungan_ec'=>$contacts_hub[$contact_key],
                    'type_contact'=>$contacts_hub[$contact_key],
                    'address'=>$contacts_addr[$contact_key]
                ]);
            }
        }

        $sosmed = [$row['fb'],$row['tw'],$row['ig'],$row['other']];
        foreach($sosmed as $indx => $val){
            $val = trim($val);
            if(empty($val[$indx])){

            }else{
                sosmedContact::updateOrCreate([
                    'id' => ($cek_customer->get()->isEmpty()) ? null : $cek_customer->get()[0]->id,
                ],[
                    'customer_id'=>$customer_save->id,
                    'fb'=> $row['fb'],
                    'tw '=>$row['tw'],
                    'ig'=>$row['ig'],
                    'other'=>$row['other']
                ]);
            }
        }

        UsersTransaction::Create([
            'uid'=>Auth::user()->id,
            'transaction_type'=> 'Create/Update',
            'transaction_val'=> ($cek_customer->get()->isEmpty()) ? 'Updating'.' data customer id '.$cek_customer->get()[0]->id : 'Creating'.' data customer id '.$cek_customer->get()[0]->id,
            'date_upload'=>$dateUpload->format('d-m-Y H:m')
        ]);

    }

    public function chunkSize(): int
    {
        return 300;
    }

    public function rules(): array
    {
        return [
            // 'id_customer' => 'unique:customer,customer_id',
            // 'ktp' => 'unique:customer,id_customer',
            // unique:users,email
            //'fullname' => 'nullable|unique:users,fullname',

        ];
    }

    // public function onFailure(Failure ...$failures)
    // {
    //     // Handle the failures how you'd like.
    // }
}
