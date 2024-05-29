<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use App\User;

class Customer extends Model
{
    use Notifiable, Sortable;
    public $timestaps = true;
    protected $primaryKey = 'id';
    protected $table = 'customer';
    protected $fillable = ['nama_customer','ktp','email','address', 'platform','nominal','customer_id','others','user_id','date_uploaded','periode_start','periode_end','tim','phone','dpd','data_status'];
    public $sortable = ['nama_customer','ktp','email','address', 'platform','nominal','customer_id','others','user_id','date_uploaded','periode_start','periode_end','tim','phone','dpd','data_status'];

    public function owner(){
        return $this->hasMany('\App\models\OwnerData','cid');
    }

    public function user(){
        // return $this->belongsToMany('\App\User','users')->using('App\user');
        return $this->belongsTo('\App\User','id');
    }


    public function customer_payments(){
        return $this->hasMany('App\models\Payments','customer_id');
    }

    public function customer_remark(){
        return $this->belongsTo('\App\models\Remark','customer_id');
    }

    public function remark(){
        return $this->hasMany('\App\models\Remark');
    }

    public function payment(){
        return $this->hasMany('\App\models\Payments');
    }

    public function contacts(){
        return $this->hasMany('\App\models\CustomerContact');
    }

    public function latestRemark(){
        return $this->hasOne('\App\models\Remark')->latest();
    }
    
    public function latestPayment(){
        return $this->hasOne('\App\models\Payments')->latest();
    }    

    public function client(){
        return $this->hasMany('\App\models\Customer','platform');
    }
    
    public function remarksSortable($query, $direction){
        return $query->join('remark', 'customer.id', '=', 'remark.customer_id')
                    ->orderBy('remark', $direction)
                    ->groupBy('customer.id');
    }

    public function ownedCustomer()
    { 
        return $this->hasMany('App\User', 'id'); 
    } 

   
    public function addressSortable($query, $direction)
    {
        
    }
}
