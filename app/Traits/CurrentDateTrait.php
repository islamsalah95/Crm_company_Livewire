<?php

namespace App\Traits;
use Illuminate\Support\Carbon;


trait CurrentDateTrait
{

    public static function getDate_Y_m_d_H_i_s()
    {
        $currentDate = Carbon::now();
       return $currentDate->format('Y-m-d H:i:s');

    }


}
