<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Platform extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'tb_platform';
    protected $fillable = ['nama'];

    public function client(){
        return $this->belongsTo('\App\models\Customer','id');
    }
}
