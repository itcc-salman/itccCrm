<?php

namespace App\MyModels;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded = [];
    protected $table = 'lead_meetings';

    public function salesPerson()
    {
        return $this->hasOne('App\User', 'id', 'sales_person_id');
    }

    public function getcreatedAtAttribute($v)
    {
        return get_date_server_full($v);
    }

    public function getmeetingAtAttribute($v)
    {
        return get_date_server($v);
    }
}
