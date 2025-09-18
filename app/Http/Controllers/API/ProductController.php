<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){ #unt
        $products = ProductModel::all(); #
        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    public function store(Request $request){ #untuk menambah data ke table
        $validation = $request->validate([ #validasi supaya data yang masuk sesuai sama table
            'name'=> 'required|string|max:255',
            'description'=>'required|string',
            'price'=> 'required|integer|min:0',
            'stock'=> 'required|integer|min:0'
        ]);

        $product = ProductModel::create($validation);
        return response()->json([
            'status' => 'success',
            'data' => $product,
            'message' => 'Product created successfuly'
        ] ,201);
        
    }

    public function show($id){
        $product = ProductModel::find($id);
        return response()->json([
            'status'=> 'success',
            'data'=> $product
        ], 200);
    }

    public function destroy($id){
        $product = ProductModel::find($id);

        if(!$product){
            return response()->json([   
                'status'=> 'error',
                'message'=> 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([   
            'status'=> 'success'
            
        ], 200);
    }

    public function update(Request $request, $id){ #request dipakai untuk mengirimkan data
        $product = ProductModel::find($id);

        if(!$product){
            return response()->json([
                'status'=> 'error',
                'message'=> 'Product not found'
            ], 404);
        }

        $validation = $request->validate([
            'name'=> 'required|string|max:255',
            'description'=>'required|string',
            'price'=> 'required|integer|min:0',
            'stock'=> 'required|integer|min:0'
        ]);

        $product->update($validation);
        return response()->json([
            'status'=> 'success',
            'data'=> $product
        ], 200);
    }

}
