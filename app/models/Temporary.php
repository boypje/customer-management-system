<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Temporary extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'temporary';
    protected $fillable = ['date','status'];
    public $sortable = ['date','status'];
}
