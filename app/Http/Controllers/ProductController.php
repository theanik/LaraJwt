<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use JWTAuth;
class ProductController extends Controller
{
    // public $user;

    // public function __constructor() 
    // {
    //     $this->user = auth()->user();
    // }
    
    public function test() 
    {
        return auth()->user()->id;
    }

    public function index()
    {
        $product = Product::all();
        if ($product){
            return response()->json([
                'success' => true,
                'product' => $product
            ],200 );
        }else{
            return response()->json([
                'success' => flase,
                'message' => 'Something went wrong!!'
            ],400);
        }
        
        
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $product = new Product();
        $product->user_id = auth()->user()->id;
        $product->name = $req->name;
        $product->price = $req->price;
        $product->quantity = $req->quantity;

        if($product->save()){
            return response()->json([
                'success' => true,
                'message' => 'Poduct Add',
                'product' => $product
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Something wend wrong!!'
            ],400);
        }
    }


    public function showAuthUserProduct()
    {

        $product = auth()->user()->products;
        if($product) {
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!!'
            ]);
        }
    }
    public function showAuthUserProductDetails($id)
    {
        $product = auth()->user()->products()->find($id);
        
        if($product) {
            return response()->json([
                'success' => true,
                'product' => $product
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found!!'
            ]);
        }
    }

    public function deleteAuthUserProduct($id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product cannot be found'
            ], 400);
        }
        if ($product->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Prouct deleted .'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product can not be deleted'
            ], 500);
        }
    }

    public function updateAuthUserProduct(Request $req, $id)
    {
        // return $req;
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product cannot be found'
            ], 404);
        }
        
        
        $product->name = $req->name ? $req->name : $product->name;
        $product->price = $req->price ? $req->price : $product->price;
        $product->quantity = $req->quantity ? $req->quantity : $product->quantity;
        $product->user_id = auth()->user()->id;

        if ($product->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Prouct Updated .'
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product can not update'
            ], 500);
        }
    }

}
