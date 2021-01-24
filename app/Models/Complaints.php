<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $fillable = ['name','email','phone_number','gender','state','country','address','complaint_type','complaint','tracking_code','complaint_status','staff_assigned','user_id','month','year'];

}
