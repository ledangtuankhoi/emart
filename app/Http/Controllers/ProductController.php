<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id','DESC')->get();
        return view('backend.products.index',compact('product'));
    }

    
    public function productStatus(Request $request)
    {
        if ($request->mode == true) {
            DB::table('product')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('product')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update status product ', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request->all());
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'description'=>'string|nullable',
            'stock'=>'nullable|numeric',
            'price'=>'nullable|numeric',
            'discount'=>'nullable|numeric', 
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'vendor_id'=>'required|exists:users,id',
            'condition'=>'nullable',
            'size'=>'nullable',
            'status'=>'required|in:active,inactive',

        ]); 

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug .= time() . "-" . $slug;
        }
        $data['slug'] = $slug; 
        $data['offer_price'] = ($request->price-($request->price*$request->discount/100))   ;
 
        // return $data;
        $status = Product::create($data);
        if ($status) {
            return redirect()->route('product.index')->with('success', 'Product Succsessfully create ');
        } else {
            return back()->with('errors', 'Somthing went wrong');
        }

        return $request->all();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id); 

        if($product){
            return view('backend.product.edit',compact('product'));
        }else{
            return back()->with('error','data not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if($product){
            return view('backend.products.edit',compact('product' ));
        }else{
            return back()->with('error','data not found');
        }
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
        $product = Product::find($id);
        if($product){
            $this->validate($request,[
                'title'=>'string|required',
                'summary'=>'string|nullable',
                'description'=>'string|nullable',
                'stock'=>'nullable|numeric',
                'price'=>'nullable|numeric',
                'discount'=>'nullable|numeric', 
                'cat_id'=>'required|exists:categories,id',
                'child_cat_id'=>'nullable|exists:categories,id',
                'vendor_id'=>'required|exists:users,id',
                'condition'=>'nullable',
                'size'=>'nullable',
                'status'=>'required|in:active,inactive',
            ]); 
            
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug .= time() . "-" . $slug;
        }
        $data['slug'] = $slug; 
        $data['offer_price'] = ($request->price-($request->price*$request->discount/100))   ;
 
                 
            $status = $product->fill($data)->save();

            // return dd($request->all(),$data,$status);
            if ($status) {
                return redirect()->route('product.index')->with('success', 'Succsess  update banner');
            } else {
                return back()->with('errors', 'Somthing went wrong');
            }
        } else {
            return back()->with('error', 'data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id); 
        if ($product) {
            $status = $product->delete();
            if ($status) { 
                return redirect()->route('product.index')->with('success', 'Succsess  product deleted');
            } else {
                return back()->with('errors', 'Somthing went wrong');
            }
        } else {
            return back()->with('error', 'data not found');
        }
    }
}
