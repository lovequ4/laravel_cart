<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $products = Product::all();
        return view ('products.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'quantity'=> 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
        
            // Store the original image
            $imagePath = 'images/' . $imageName;
            Image::make($image->getRealPath())->save(public_path($imagePath));
            $product->image = $imagePath;

            // Create and store a thumbnail
            $thumbnailPath = 'images/thumbnails/' . $imageName;
            $thumbnail = Image::make($image->getRealPath())->fit(100, 100);
            $thumbnail->save(public_path($thumbnailPath));

            $product->thumbnail = $thumbnailPath;
        }
        else{
            $product->image = 'images/none-image.jpg';
            $product->thumbnail = 'images/thumbnails/thumb_none.jpg';
        }     

        $product->save();
          
        return redirect()->route('products.index2');     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'text',
            'price' => 'integer',
            'quantity'=>'integer',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);
    
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->extension();
            $image->move(public_path('images'), $imageName);

            
            $thumbnailPath = public_path('images/thumbnails'); 
            $thumbnailName = 'thumb_' . $imageName; // 

         
            Image::make(public_path('images/' . $imageName))
                ->fit(100, 100)
                ->save($thumbnailPath . '/' . $thumbnailName);

            $product->thumbnail_url = 'images/thumbnails/' . $thumbnailName;
        
        }else{
            $product->image_url = 'resources/static/none-image.jpg';

            $defaultThumbnailPath = public_path('images/thumbnails');
            $defaultThumbnailName = 'thumb_none.jpg';

            Image::make(public_path('images/none.jpg'))
                ->fit(100, 100)
                ->save($defaultThumbnailPath . '/' . $defaultThumbnailName);
        
            $product->thumbnail_url = 'images/thumbnails/' . $defaultThumbnailName;
        };
    
        $product->save();
    
        return redirect()->route('products.show', ['product' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
    
        if ($product) {
            $product->delete();
            return redirect()->route('products.index2')->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->route('products.index2')->with('error', 'Product not found.');
        }
    }
    

    //for admin panel
    public function index2():View
    {
        $products = Product::all();
        return view ('products.index2',['products' => $products]);
    }
}
