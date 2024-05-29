<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'client';
    protected $fillable = ['client_name','bucket_detail','mgr_id'];
    public $sortable = ['client_name','bucket_detail','mgr_id'];

    // public function customerKontak(){
    //     return $this->hasMany('\App\models\Customer','id');
    // }
}
