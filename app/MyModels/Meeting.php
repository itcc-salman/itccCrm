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

    public function lead()
    {
        return $this->hasOne('App\MyModels\Lead', 'id', 'lead_id');
    }

    public function getcreatedAtAttribute($v)
    {
        return get_date_server_full($v);
    }

    public function MeetingMonth()
    {
        return date('M', strtotime($this->attributes['meeting_at']));
    }

    public function MeetingDate()
    {
        return date('d', strtotime($this->attributes['meeting_at']));
    }

    public function getmeetingAtAttribute($v)
    {
        return get_date_server($v);
    }
}
