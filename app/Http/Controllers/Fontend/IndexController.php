<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('3')->get();
        $categories = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('id','DESC')->limit('10')->get();
        // dd($categories);

        return view('fontend.index',compact(['banners','brands','categories']));
    }

    public function productCategory(Request $request,$slug){
        $categories = Category::with(['products'])->where('slug',$slug)->first();
        $sort = '';
        if($request->sort != null){
            $sort = $request->sort;
        }
        if($categories == null){
            return view('errors.404');
        }else{
            if($sort=='priceAsc'){
                $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->orderby('offer_price','asc')->paginate(12);
            }elseif($sort=='priceDesc'){
                $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->orderby('offer_price','DESC')->paginate(12);
            }elseif($sort=='titleAsc'){
                $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->orderby('title','Asc')->paginate(12);
            }elseif($sort=='titleDesc'){
                $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->orderby('title','DESC')->paginate(12);
            }elseif($sort=='discAsc'){
                $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->orderby('price','ASC')->paginate(12);
            }elseif($sort=='discAsc'){
                $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->orderby('price','DESC')->paginate(12);
            }else{
                $products = Product::where(['status'=>'active','cat_id'=>$categories->id])->paginate(12);
            }
        }

        $route = 'product-category';
        return view('fontend.pages.product.product-category',compact(['categories','route','products']));
    }

    public function productDetail($slug){
        $product = Product::with('rel_prods')->where('slug',$slug)->first();
        // return $product;
        if($product){
            return view('fontend.pages.product.product-detail',compact('product'));
        }else{
            return 'Product detail not found';
        }
    }


    public function userAuth(){
        return view('fontend.auth.auth');
    }

    public function loginSumit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:4',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password,'status'=>'active'])){
            Session::put('user',$request->email);

            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }
            else{ 
                return redirect()->route('home')->with('success','Succsessfully Login ' );
            }
        }else{ 
            return back()->with('error','Invalid email & password');
        }
    }
    
    public function regiterSumit(Request $request){ 
        $this->validate($request,[
            'full_name'=>'required|string',
            'username'=>'nullable|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:4|confirmed',
        ]);
        
        $data = $request->all();
        $check = $this->create($data);
        Session::put('user',$data['email']);
        Auth::login($check);
        if($check){
            return redirect()->route('home')->with('success','Register Successfully and login');
        }else{
            return back()->with('error','please check Your credential');
        }
    }

    private function create(array $data){
        return User::create([
            'full_name'=>$data['full_name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
        ]);
    }

    public function userLogout(){
        Session::forget('user');
        Auth::logout();
        return redirect()->route('home')->with('success','Successfully Logout');
    }

    public function userInfo(){
        return view('fontend.layouts.user_info');
    }
}
