<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function getStartDateAttribute($value)
    {
        if ($value !== null) {
            return Carbon::parse($value)->format('d M Y');
        }
    }

    public function getEndDateAttribute($value)
    {
        if ($value !== null) {
            return Carbon::parse($value)->format('d M Y');
        }
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Helper::parseDate($value);
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Helper::parseDate($value);
    }
}
