<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(25);
        //
        ProductResource::collection($products);
        return response()
        ->json([
            'data'=>$products->all(),
            'currentPage'=>$products->currentPage(),
            'lastPage'=>$products->lastPage(),
        ]);
    }
    public function show(Product $product)
	{
	    return $product;
	}

    public function store(Request $request)
	{
        $this->validate($request, [
            'title' => 'required|unique:products|max:255',
            'description' => 'required',
            'price' => 'integer',
        ]);

	    $product = Product::create($request->all());
	    return response()->json($product, 201);
	}
    public function update(Request $request, Product $product)
	{
	    $product->update($request->all());
	    return response()->json($product, 200);
	}
    public function delete(Product $product)
	{
	    $product->delete();
	    return response()->json(null, 204);
	}
}
