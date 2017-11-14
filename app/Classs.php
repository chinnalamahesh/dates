<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Classs extends model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'ex_classes';
    public $fillable = ['cls_name', 'status', 'location_name','room','sesn_name','cls_start_date','cls_end_date','cls_start_time',
		'cls_end_time','duration','tuition_fee','per_day','tutn_bill_mthd','gender','min_age','max_age'];

}

