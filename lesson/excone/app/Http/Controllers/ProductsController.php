<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }

    
    public function create()
    {
        return view('products.create');
    }

    
    public function store(Request $request)
    {

        // => 1. Public folder (public/customfolder/)

        // $request->image->move('customfolder',$imagename);
        // $request->image->move(public_path('customfolder'),$imagename);


        // => 2. Storage Folder / Local Driver (storage/app/customfolder)

            // php artisan storage:link

            // $request->image->store('path/');

            // use Illuminate\Support\Facades\Storagee
            // Storage::disk('local')->put('$customfolder',$file,content,'optional');

            // $request->image->storeAs($file,$imagename,optional drive);

            $product = new Product();
            $product->name  = $request['name'];
            $product->price  = $request['price'];

            $file = $request->file('image');

            // if($file){

            //     $fname = $file->getClientOriginalName();

            //     // $imagenewname = date('ymdHis').$fname;
            //     // $imagenewname = time().$fname;
            //     $imagenewname = uniqid().$fname;

            //     // dd($imagenewname);

            //     $file->move('images',$imagenewname);

            //     $product->image = $imagenewname;

            // }


            // if($file){

            //     $fname = $file->getClientOriginalName();

            //     $imagenewname = time().$fname;

            //     // $fileurl = $file->move('images',$imagenewname); // 	images\1696765573user1.jpg
            //     $fileurl = $file->move(public_path('images'),$imagenewname); // 	E:\laravelbatch1\lesson\excone\public\images\1696765533user1.jpg

            //     $product->image = $fileurl;

            // }


            // if($request->hasfile('image')){

            //     $fnameext = $file->getClientOriginalExtension(); // jpg
            //     $imagenewname = uniqid().'.'.$fnameext; // 652299784d1ee.jpg

            //     // dd($imagenewname);

            //     $file->storeAs('images',$imagenewname); // public_path ကို storeAs နဲ့သုံးလို့မရ moveနဲ့ပဲရမှာ

            //     $product->image = $imagenewname;

            // }


            // if($request->hasfile('image')){

            //     $fnameext = $file->extension(); // jpg
            //     $imagenewname = time().'.'.$fnameext; // 652299784d1ee.jpg

            //     // dd($imagenewname);

            //     $file->storeAs('public/images',$imagenewname); 

            //     $product->image = $imagenewname;

            // }


            // if($request->hasfile('image')){

            //     $fnameext = $file->extension(); // jpg
            //     $imagenewname = time().'.'.$fnameext; // 1696767008.jpg

            //     // dd($imagenewname);

            //     $fileurl = $file->storeAs('public/images',$imagenewname); // public/images/1696767008.jpg

            //     $product->image = $fileurl;

            // }


            // if($request->hasfile('image')){

            //     // $fileurl = $file->store(); // sARnEtN5YaTLRvn9x01tbyZTdl1uaJf9tz9UXscF.jpg
            //     $fileurl = $file->store('images'); // images/WzZUjUUIf1XKdwi6WtrygpR3DZRJOMpG7reHUxm5.jpg
            //     $product->image = $fileurl;

            // }


            // if($request->hasfile('image')){

            //     $fnameext = $file->extension();
            //     $imagenewname = uniqid().'.'.$fnameext;

            //     // dd($file->get());
            //     // dd(file_get_contents($file));

            //     Storage::disk('local')->put('images/'.$imagenewname,$file->get());

            //     $product->image = $imagenewname;

            // }


            if($request->hasfile('image')){

                $fnameext = $file->extension();
                $imagenewname = uniqid().'.'.$fnameext;

                // dd($file->get());
                // dd(file_get_contents($file));

                Storage::disk('local')->put('images/'.$imagenewname,file_get_contents($file),'public');
                //Storage နဲ့တော့filepathယူလို့မရဘူး သူက true falseပဲ return ပြန်ပေးမှာမလို့

                $fileurl = "public/app/images/". $imagenewname;
                $product->image = $fileurl;

            }



            $product->save();
            return redirect(route('products.index'));

    }

    
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show',["product"=>$product]);
    }

    
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit')->with('product',$product);
    }

    
    public function update(Request $request, string $id)
    {
        Product::findOrFail($id)->update([
            'name'=>$request['name'],
            'price'=>$request['price']
        ]);
        return redirect(route('products.index'));
    }

    
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back();
    }
}

