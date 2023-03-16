<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Requests\CreateCandyRequest;

class CategoryController extends Controller
{
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(){
        $candy = $this->categoryService->list();
        return response($candy, 200);
    }

    public function create(CreateCandyRequest $request){
        $candy = $this->categoryService->create($request);
        return response($candy, 200);
    }

    public function show($id){
        $candy = $this->categoryService->show($id);
        return response($candy, 200);
    }

}
