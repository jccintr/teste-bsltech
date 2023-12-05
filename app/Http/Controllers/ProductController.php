<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('nome')->get();
        return response()->json($products,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'required|min:3',
            'preco' => 'required|numeric|gt:0',
        ]);

        $product = Product::create($request->all());
        return response()->json($product,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['error'=>'Product not found.'],404);
        }
        return response()->json($product,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Product::find($id);
        if(!$product){
            return response()->json(['error'=>'Product not found.'],404);
        }

        $request->validate([
            'nome' => 'required|min:3',
            'descricao' => 'required|min:3',
            'preco' => 'required|numeric|gt:0',
        ]);

        $product->update($request->all());
        return response()->json($product,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['error'=>'Product not found.'],404);
        }
        $product->delete();
        return response()->json(['message'=>'Product deleted.'],200);

    }
}
