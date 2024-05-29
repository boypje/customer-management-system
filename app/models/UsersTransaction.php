<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UsersTransaction extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'users_transaction';
    protected $fillable = ['uid','transaction_type','transaction_val','date_upload'];

    public function userTransaction(){
        return $this->hasOne('\App\models\OwnerData','uid');
    }
    
}


