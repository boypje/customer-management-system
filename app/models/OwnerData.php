<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OwnerData extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'owner_data';
    protected $fillable = ['uid','cid'];

    public function customer(){
        return $this->belongsTo('\App\models\Customer','id',);
    }
    
    public function onwnedTransaction(){
        return $this->belongsTo('\App\models\UsersTransaction','uid',);
    }
}
