<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    public static function parseDate($date, $toFormat = 'Y-m-d', $fromFormat = 'd/m/Y')
    {
        return Carbon::createFromLocaleFormat($fromFormat, 'id', $date)->format($toFormat);
    }
}
