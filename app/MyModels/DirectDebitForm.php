<?php

namespace App\MyModels;

use Illuminate\Database\Eloquent\Model;

class DirectDebitForm extends Model
{
    protected $guarded = [];

    protected $table = 'direct_debit_forms';

    public function getcreatedAtAttribute($v)
    {
        return get_date_server($v);
    }

}
