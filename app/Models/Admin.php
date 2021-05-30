<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Admin extends Model
{
    use HasFactory;

    protected $fillable=[
        'id','user_id'
     ];

    protected $primaryKey ='id';
    protected $table ='admins';

    public function getUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
