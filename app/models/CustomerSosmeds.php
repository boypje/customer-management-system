<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomerSosmeds extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'customer_sosmeds';
    protected $fillable = ['customer_id','fb','tw','ig','other'];

    public function customerSosmed(){
        return $this->hasMany('\App\models\Customer');
    }
}
