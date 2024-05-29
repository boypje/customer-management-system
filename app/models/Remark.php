<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Remark extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'remark';
    protected $fillable = ['user_id','customer_id','remark_type','description','date_remark','verification','category','status_call','applicant_type','number','duration','role','trigger_time','call_start','call_end','ptp'];
    public $sortable = ['user_id','customer_id','remark_type','description','date_remark','verification','category'];
    public $timestaps = true;

    public function customer(){
        return $this->belongsTo('\App\models\Customer');
    }

    public function users_remark(){
        return $this->belongsTo('\App\User');
    }
    public function user(){
        return $this->belongsTo('\App\User');
    }

}
