<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private const PER_PAGE = 25;

    public function index(): JsonResponse
    {
        $products = Category::paginate(self::PER_PAGE);
        $collection = CategoryResource::collection($products);
        return response()
        ->json($collection);
    }
}
