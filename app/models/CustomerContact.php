<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class CustomerContact extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'customer_contacts';
    protected $fillable = ['customer_id','contact_name','type_contact','address','number_contact','hubungan_ec'];
    public $sortable = ['customer_id','contact_name','type_contact','address','number_contact','hubungan_ec'];

    public function customerKontak(){
        return $this->hasMany('\App\models\Customer','id');
    }
}
