<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CandyService;
use App\Http\Requests\CreateCandyRequest;

class CandyController extends Controller
{
    public function __construct(CandyService $candyService)
    {
        $this->candyService = $candyService;
    }

    public function search(Request $request){
        $candy = $this->candyService->search($request);
        return response($candy, 200);
    }

    public function create(CreateCandyRequest $request){
        $candy = $this->candyService->create($request);
        return response($candy, 200);
    }

    public function wallet(){
        $candy = $this->candyService->wallet();
        return response($candy, 200);
    }

    public function show($id, Request $request){
        $candy = $this->candyService->show($id, $request);
        return response($candy, 200);
    }

    public function transactions($id, Request $request){
        $candy = $this->candyService->transactions($id, $request);
        return response($candy, 200);
    }

    public function complete($id, Request $request){
        $candy = $this->candyService->complete($id, $request);
        return response($candy, 200);
    }
}
