<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
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
        $products = Product::all();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'discount' => 'required',
                'sp' => 'required',
                'description' => 'required',
            ]
        );

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->sp = $request->sp;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        // We need to save product first so that we can get product ID for Product Image Table

        if($request->hasFile('images')){
            foreach($request->images  as $image){
                $productImage = new ProductImage();
                $newName = time() . $image->getClientOriginalName();
                $image->move('images',$newName);
                $productImage->name = 'images/' . $newName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('backend.product.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'discount' => 'required',
                'sp' => 'required',
                'description' => 'required',
            ]
        );

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->sp = $request->sp;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->update();

        // We need to save product first so that we can get product ID for Product Image Table

        if($request->hasFile('images')){
            foreach($request->images  as $image){
                $productImage = new ProductImage();
                $newName = time() . $image->getClientOriginalName();
                $image->move('images',$newName);
                $productImage->name = 'images/' . $newName;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
