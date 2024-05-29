<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class BucketClient extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'bucket_client';
    protected $fillable = ['bucket_name','dpd'];
    public $sortable = ['bucket_name','dpd'];

    // public function customerKontak(){
    //     return $this->hasMany('\App\models\Customer','id');
    // }
}
