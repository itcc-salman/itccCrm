<?php

namespace App\MyModels;

use Illuminate\Database\Eloquent\Model;

class DigitalSalesForm extends Model
{
    protected $guarded = [];

    protected $table = 'digital_sales_forms';

    public function setProjectStartDateAttribute($v)
    {
        $this->attributes['project_start_date'] = set_date_server($v);
    }

    public function getprojectStartDateAttribute($v)
    {
        return get_date_server($v);
    }

    public function getcreatedAtAttribute($v)
    {
        return get_date_server($v);
    }

    public function getprojectAmountAttribute($v)
    {
        return "$".number_format($v, 2);
    }

    public function getsubTotalAttribute($v)
    {
        return "$".number_format($v, 2);
    }

    public function getgstTotalAttribute($v)
    {
        return "$".number_format($v, 2);
    }

    public function gettotalAmtAttribute($v)
    {
        return "$".number_format($v, 2);
    }

    public function setProjectServicesAttribute($v)
    {
        $val = implode(',', $v);
        $this->attributes['project_services'] = $val;
    }

    public function getProjectServicesAttribute($v)
    {
        $val = explode(',', $v);
        return $val;
    }

    public function digitalSalesItems()
    {
        return $this->hasMany('App\MyModels\DigitalSalesItems','digital_sales_id', 'id');
    }

    public function lead()
    {
        return $this->hasOne('App\MyModels\Lead', 'id', 'lead_id');
    }

    public function salesPerson()
    {
        return $this->hasOne('App\User', 'id', 'sales_person_id');
    }
}
