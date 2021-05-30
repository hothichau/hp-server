<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'id','user_id','age','height','weight','gender'
     ];

    protected $primaryKey ='id';
    protected $table ='customers';

    public function getUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getService(){
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }
}
