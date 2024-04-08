<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return new JsonResponse(
            Product::query()->paginate(
                perPage: (int)$request->query('per_page', '20'),
                page: (int)$request->query('page', '1')
            )
        );
    }
}
