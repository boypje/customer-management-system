<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
// Please add this line
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
//spatie media library
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable implements HasMedia, JWTSubject
{
    use Notifiable;
    use HasRoles;
    use HasMediaTrait;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'employee_id','ktp','kk','passport','npwp','fullname',
        'tempat_lahir','tanggal_lahir','email','jabatan','divisi',
        'agama','status_pernikahan','kewarganegaraan',
        'kerabat','golongan_darah','sosmed','user_status','note',
        'ec_families','graduated_from','password','join_date','tlp_hp','tlp_rumah',
        'almt_domisili','almt_ktp','resume','f_diri','f_kk','f_ijazah','pendidikan',
        'p_kerja','f_ktp','n_ibu_kandung','ec1','ec2','suku','s_keluraga_orangtua','s_keluarga_sendiri', 'last_session',
        'dpd','data_status'
    ];

    public $sortable = [
        'employee_id','ktp','kk','passport','npwp','fullname',
        'tempat_lahir','tanggal_lahir','email','jabatan','divisi',
        'agama','status_pernikahan','kewarganegaraan',
        'kerabat','golongan_darah','sosmed','user_status','note',
        'ec_families','graduated_from','password','join_date','tlp_hp','tlp_rumah',
        'almt_domisili','almt_ktp','resume','f_diri','f_kk','f_ijazah','pendidikan',
        'p_kerja','f_ktp','n_ibu_kandung','ec1','ec2','suku','s_keluraga_orangtua','s_keluarga_sendiri', 'last_session'
    ];
    protected $appends = ['NamaLengkap','full_name_user'];
    public $timestaps = true;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ruang' => 'array',
        'pendidikan' => 'array',
        'tanggal_lahir' => 'datetime:d-m-Y',
    ];

    public function getNamaLengkapAttribute(){
        return $this->fullname;
    }

    public function getFullNameUserAttribute()
    {
        return ucfirst($this->fullname);
        // return $this->full_name;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function profile(){
        return $this->hasOne('\App\models\Profile');
    }

    public function bisa(array $permissions):bool
    {
        return $this->hasAnyPermission($permissions);
    }

    //membership (to hide super admin visibility from another member )
    public function scopeMember($query){
        return $query->where('email','!=','admin@local.host');
    }

    public function scopeActive($q){
        return $q->where('user_status', 'aktif');
    }


    function alamat(){
        $users = User::where('address')->get();
        $alamat = json_decode($users)->domisili;

        return $alamat;
    }

    public function customer(){
        // return $this->belongsToMany('\App\models\Customer','uid')->using('App\models\Customer');
        return $this->hasMany('\App\Models\Customer','user_id');
    }
    
    // Please ADD this two methods at the end of the class
    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }

    public function payments(){
        return $this->hasMany('\App\models\Payments');
    }

    public function remarks(){
        return $this->hasMany('\App\models\Remark');
    }
}
