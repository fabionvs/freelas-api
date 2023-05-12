<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Business;

class BusinessRepository
{

    public function search($request)
    {
        $filiais = Business::select(
            DB::raw("*, ROUND(
                3959 * ACOS(
                  COS(RADIANS(?)) *
                  COS(RADIANS(latitude)) *
                  COS(RADIANS(longitude) - RADIANS(?)) +
                  SIN(RADIANS(?)) * SIN(RADIANS(latitude))
                ) * 1.6
              ,1)  AS km_away")
            )
            //->having("km_away", "<", "?")
            ->setBindings([$request->input('latitude'), $request->input('longitude'), $request->input('latitude')]);
             if($request->input('nm_categoria') !== ""){
                $filiais->where('nm_categoria', 'LIKE', '%'.$request->input('nm_categoria')."%");
            }
            return $filiais->orderBy("km_away")->get();

    }

}
