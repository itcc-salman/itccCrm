<?php

namespace App\MyModels;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public function getcreatedAtAttribute($v)
    {
        return get_date_server_full($v);
    }

    public function customer()
    {
        return $this->hasOne('App\MyModels\Customer', 'id', 'customer_id');
    }

    public function meetings()
    {
        return $this->hasMany('App\MyModels\Meeting','lead_id', 'id');
    }
}
