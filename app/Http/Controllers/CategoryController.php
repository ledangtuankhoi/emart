<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('categories'));
    }

    public function categoryStatus(Request $request)
    { 
        if ($request->mode == true) {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update status Category ', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cat = Category::where('is_parent',1)->orderBy('title','ASC')->get();

        return view('backend.category.create',compact('parent_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd("store",$request->all());
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            // validation 'in' kiểm tra chỉ trong value đó thui
            'is_parent'=>'sometimes|in:1',
            // validation 'exists' kiểm tra chỉ thuộc trong giá trị của bảng cate cột id
            'parent_id'=>'nullable|exists:categories,id',
            'status'=>'required|in:active,inactive'
        ]);
        
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug .= time() . "-" . $slug;
        }
        $data['slug'] = $slug; 
        if($request->input('is_parent') == 1){
            $data['parent_id'] = null;
            $data['is_parent'] = 1;
        }else{
            $data['parent_id'] = $request->input('parent_id');
            $data['is_parent'] = 0;
        } 
 

        $status = Category::create($data);
        if ($status) {
            return redirect()->route('category.index')->with('success', 'Category Succsessfully create ');
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
        $category = Category::find($id);
        $parent_cat = Category::where('is_parent',1)->orderBy('title','ASC')->get();

        if($category){
            return view('backend.category.edit',compact('category','parent_cat'));
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
         $category = Category::find($id);
        if ($category) {
            $this->validate($request,[
                'title'=>'string|required',
                'summary'=>'string|nullable',
                'is_parent'=>'sometimes|in:1',
                'parent_id'=>'nullable|exists:categories,id',
                'status'=>'nullable|in:active,inactive'
            ]);

            $data = $request->all();
                
            
            $status = $category->fill($data)->save();

            // return dd($request->all(),$data,$status);
            if ($status) {
                return redirect()->route('category.index')->with('success', 'Succsess  update banner');
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
        $category = Category::find($id);
        $child_cat_id = Category::where('parent_id',$id)->pluck('id');
        if ($category) {
            $status = $category->delete();
            if ($status) {
                if(count($child_cat_id)>0){
                    Category::shiftChild($child_cat_id);
                }
                return redirect()->route('category.index')->with('success', 'Succsess  category deleted');
            } else {
                return back()->with('errors', 'Somthing went wrong');
            }
        } else {
            return back()->with('error', 'data not found');
        }
    }

    public function getChildByParentID(Request $request, $id){
        // return "asdf"+$id; 
        // dd($id,$request->all());
        $category = Category::find($request->id);
        $child_id = Category::getChildByParentID($request->id);
        if($category){
            if (count($child_id)<=0) {
                return response()->json(['status'=>false,'data'=>null,'msg'=>'']);
            }
            return response()->json(['status'=>true,'data'=>$child_id,'msg'=>'']);
            
        }else{
            return response()->json(['status'=>false,'data'=>null,'msg'=>' Category Not Found']);   
        }
        
    }
}
