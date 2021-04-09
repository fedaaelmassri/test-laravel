<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
       //Function  Get All Products    

    public function index()
    {
        $products = Product::get();
         return view('products.index')->with('products', $products);
    }

     //Function Show  Page View Add New Product    

    public function create()
    {
          return view('products.create');
    } 

     //Function  Store New Product  In DataBase   

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required' ],
            'price' => ['required'],
            'details' => ['required'],
        
        ]);
        $product=new Product();
        $product->name = $request->name;
       $product->price = $request->price;
       $product->details = $request->details;
       if ($request->hasFile('image')) {
            $image = $request->file('image');
             $path = $image->store('images', 'public');

        } else {

            $path = null;
        }
       $product->image = $path;
       if($product->save()){
        return redirect(route('products'))->with([
           'message' => sprintf('Success !' ),
           'alert-type' => 'success'
             ]);
        }
        else {
            return redirect()->back()->with([
                'message' => sprintf('Error!!!!'),
                'alert-type' => 'error'
            ])->withInput();
        }
     }

     //Function  Delete Product      

    public function delete($id)
    {
        $product = Product::findOrfail($id);
        if (!empty($product)) {
            $product->delete();
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        return response()->json($data);
    }

     //Function Get  Product  and view in page to edit 

    public function edit($id)
    {
        $product = Product::findOrfail($id);
        if (!$product) {
            return redirect()->back()->with([
                'message' => sprintf('The Product can not found!'),
                'alert-type' => 'error'
            ]);
        }
        return  view('products.edit', [
            'product' =>  $product,


        ]);
    }
     //Function update Product    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required' ],
            'price' => ['required'],
            'details' => ['required'],
        
        ]);
        $product = Product::findOrfail($id);
        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $path = $image->storeAs('images', basename($products->image), 'public');
            $products->image = $path;
        }
        $product->name = $request->name;
       $product->price = $request->price;
       $product->details = $request->details;
       $product->status = $request->status;
            if ($product->save()) {
            return redirect(route('products'))->with([
                'message' => sprintf(' The Product edit success !' ),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf(' The Product  can not edit success !'),
                'alert-type' => 'error'
            ])->withInput();
        }
    }

}
