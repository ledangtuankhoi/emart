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
use Laravel\Ui\Presets\React;

class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(['status'=>'active','condition'=>'banner'])->orderBy('id','DESC')->limit('3')->get();
        $categories = Category::where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit('3')->get();
        $brands = Brand::where(['status'=>'active'])->orderBy('id','DESC')->limit('10')->get();
        // dd($categories);
        
        $user = Auth::user();  
        return view('fontend.index',compact(['banners','brands','categories','user']));
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

        if($request->ajax()){
            $view = view('fontend.layouts._single-product',compact('products'))->render();
            return response()->json(['html'=>$view]);
        }
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

    public function userDashboard(){
        $user = Auth::user(); 
        return view('fontend.user.dashboard',compact(['user']));
    }

    public function userAddress (){
        $user = Auth::user(); 
        return view('fontend.user.address',compact(['user']));
    }

    public function userAccount (){
        $user = Auth::user(); 
        return view('fontend.user.account',compact(['user']));
    }
    public function userOrder (){
        $user = Auth::user(); 
        return view('fontend.user.order',compact(['user']));
    }

    public function billingAddress(Request $request, $id){
        $user = User::where('id',$id)->update([
            'country'=>$request->country,
            'city'=>$request->city,
            'postcode'=>$request->postcode,
            'state'=>$request->state,
            'address'=>$request->address,
        ]);
        if($user){
            return back()->with('success','Successfully update address ');
        }else{
            return back()->with('error','update error');
        } 
    }
    public function shipingAddress(Request $request, $id){
        $user = User::where('id',$id)->update([
            'scountry'=>$request->scountry,
            'scity'=>$request->scity,
            'spostcode'=>$request->spostcode,
            'sstate'=>$request->sstate,
            'saddress'=>$request->saddress,
        ]);
        if($user){
            return back()->with('success','Successfully update ship address ');
        }else{
            return back()->with('error','update error');
        } 
    }

    public function accountUpdate (Request $request, $id){
        return $request->all();
    }
}
