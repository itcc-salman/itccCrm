<?php

namespace App\MyModels;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    public function getCustomerFullName()
    {
        return $this->attributes['first_name'].' '.$this->attributes['last_name'];
    }

    public function get_industry()
    {
        return $this->hasOne('App\MyModels\Industry','id','industry');
    }
}
