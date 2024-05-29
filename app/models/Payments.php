<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Payments extends Model
{
    use Notifiable, Sortable;
    public $timestaps = true;

    protected $primaryKey = 'id';
    protected $table = 'payments';
    protected $fillable = ['customer_id','user_id','payment_id','category_payment','nominal','proof_of_payment','date_payment','description'];
    public $sortable = ['customer_id','user_id','payment_id','category_payment','nominal','proof_of_payment','date_payment','description'];

    public function customer_payments(){
        return $this->belongsTo('\App\models\Customer', 'customer_id');
    }

    public function user_payment(){
        return $this->belongsTo('\App\User');
    }
}