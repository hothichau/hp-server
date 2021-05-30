<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Service extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','price','description'
     ];
    protected $primaryKey ='id';
    protected $table ='services';

}
