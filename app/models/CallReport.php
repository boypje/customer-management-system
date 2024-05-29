<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CallReport extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'call_report';
    protected $fillable = ['customer_id','status_call','application_type','number','duration','role','trigger_time','agent_id','call_start','call_end'];
}
