<?php

namespace App\MyModels;

use Illuminate\Database\Eloquent\Model;

class WebSalesItems extends Model
{
    protected $guarded = [];

    protected $table = 'web_sales_items';

    public function getunitPriceAttribute($v)
    {
        return "$".number_format($v, 2);
    }

    public function gettotalAttribute($v)
    {
        return "$".number_format($v, 2);
    }

}
