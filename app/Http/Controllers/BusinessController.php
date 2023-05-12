<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BusinessService;
use App\Http\Requests\CreateCandyRequest;

class BusinessController extends Controller
{
    public function __construct(BusinessService $businessService)
    {
        $this->businessService = $businessService;
    }

    public function search(Request $request){
        $candy = $this->businessService->search($request);
        return response($candy, 200);
    }

}
