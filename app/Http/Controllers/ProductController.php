<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('product', ['allProducts' => $products]);
    }

    public function admin()
    {        
        $products = Product::get();
        return view('products.index', ['allProducts' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('products.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datos = request()->except(['_token','_method']);
        
        Product::create([
            'name' => $datos['name'],
            'autor' => $datos['autor'],
            'editorial' => $datos['editorial'],
            'description' =>$datos['description'],
            'categoria' =>$datos['categoria'],
            'price' =>$datos['price'],
            'unidades' =>$datos['unidades'],
            'img' =>$datos['img']->getClientOriginalName()
        ]);
        
        $file = $datos['img'];
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/images/libreria/',$name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Product::where("id","=",$id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $datos = request()->except(['_token','_method']);

        if(count($datos) == 7){

            Product::find($id)->update([
                                'name'=>$datos['name'],
                                'autor' => $datos['autor'],
                                'editorial' => $datos['editorial'],
                                'description' =>$datos['description'],
                                'categoria' =>$datos['categoria'],
                                'price' =>$datos['price'],
                                'unidades' =>$datos['unidades']
                            ]);
        
        }else{
            
            Product::find($id)->update([
                                'name'=>$datos['name'],
                                'autor' => $datos['autor'],
                                'editorial' => $datos['editorial'],
                                'description' =>$datos['description'],
                                'categoria' =>$datos['categoria'],
                                'price' =>$datos['price'],
                                'unidades' =>$datos['unidades'],
                                'img'=>$datos['img']->getClientOriginalName()
                            ]);
            
            $file = $datos['img'];
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/images/libreria/',$name);

        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id','=',$id)->Delete();
    }
}
