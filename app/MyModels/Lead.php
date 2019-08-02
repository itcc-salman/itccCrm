<?php

namespace App\MyModels;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public function getcreatedAtAttribute($v)
    {
        return get_date_server_full($v);
    }

    public function getCustomerFullName()
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
    }

    public function salesPerson()
    {
        return $this->hasOne('App\User', 'id', 'sales_person_id');
    }

    public function get_industry()
    {
        return $this->hasOne('App\MyModels\Industry','id','industry');
    }

    public function meetings()
    {
        return $this->hasMany('App\MyModels\Meeting','lead_id', 'id');
    }
}
