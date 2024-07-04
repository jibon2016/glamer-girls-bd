<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Type;
use App\Models\Color;
use App\Models\Weight;
use App\Models\Variation;
use DB;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function productExport(){
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function index()
    {
      
      	if(!auth()->user()->can('product.view'))
        {
            abort(403, 'unauthorized');
        }
      
        $q=request()->q;
        $query=Product::query();
                if(!empty($q)){
                    $query->where(function($row) use ($q){
                        $row->where('name','Like','%'.$q.'%');
                        $row->orwhere('description','Like','%'.$q.'%');
                      	$row->orwhere('sku','Like','%'.$q.'%');
                    });
                }
      			
      		if(auth()->user()->hasRole('admin')==false){
              $query->where('user_id', auth()->user()->id);
            }
     
        $items=$query->latest()->paginate(30);
        // dd($items);
        
        return view('backend.products.index', compact('items','q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubcategory(){

        $cats=Category::where('parent_id', request('cat_id'))->select('name','id')->pluck('name','id')->toArray();

        return response()->json($cats);
    }
    public function create()
    {
        if(!auth()->user()->can('product.create'))
        {
            abort(403, 'unauthorized');
        }

        $cats=Category::whereNull('parent_id')->get();
        $sizes=Size::all();
        $types=Type::all();
        $colors=Color::all();
        $weights=Weight::all();
        return view('backend.products.create', compact('cats','sizes','types','colors','weights'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('product.create'))
        {
            abort(403, 'unauthorized');
        }

        $data=$request->validate([
             'name'=> 'required',
             'type'=> 'required',
             'image'=> 'required|image',
             'category_id'=> 'required',
             'sub_category_id'=> '',
             'type_id'=> '',
             'description'=> '',
             'body'=> '',
             'feature'=> '',
             'sku'=> '',
             'purchase_price'=> '',
             'sell_price'=> 'required|numeric',
             'regular_price'=> '',
             'delivery_charge'=> 'numeric',
             'is_stock' => '',
             'video_link' => ''
        ]);
      
      $data['user_id']=auth()->user()->id;

    DB::beginTransaction();

        try {

        if($request->hasFile('image')) {
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('products'), $fileName);
            $data['image']=$fileName;
        }



        $product=Product::create($data);

        if(isset($request->images)) {

            $image_data=[];
            $fileName='';
            foreach ($request->images as $key => $image) {
                $originName = $image->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
            
                $image->move(public_path('products'), $fileName);
                $image_data[]=['image'=>$fileName];
            }

            if (!empty($image_data)) {
                $product->images()->createMany($image_data);
            }
            
        } 
        
        if ($request->type == 'variable') {
            
            $variable_data=[];
            
            $variable_data[] = [
                'size_id'=>"3",
                'color_id'=>"1",
                'weight_id'=>"1",
                'price'=>$request->sell_price,    
            ];
            
            foreach ($request->size_id as $key => $size) {
               $variable_data[]=[
                    'size_id'=>$size,
                    'color_id'=>$request->color_id[$key],
                    'weight_id'=>$request->weight_id[$key],
                    'price'=>$request->price[$key],
               ];
            }

            if (!empty($variable_data)) {
                $product->variations()->createMany($variable_data);
            }
            
        } else {
            $variable_data=[];
            
            $variable_data[] = [
                'size_id'=>"3",
                'color_id'=>"1",
                'weight_id'=>"1",
                'price'=>$request->sell_price,    
            ];
            if (!empty($variable_data)) {
                $product->variations()->createMany($variable_data);
            }
        }

        // if (isset($request->size_id)) {

        //     $variable_data=[];
        //     foreach ($request->size_id as $key => $size) {
        //       $variable_data[]=[
        //             'size_id'=>$size,
        //             'color_id'=>$request->color_id[$key],
        //       ];
        //     }

        //     if (!empty($variable_data)) {
        //         $product->variations()->createMany($variable_data);
        //     }
            
        // }

        DB::commit();
        return response()->json(['status'=>true ,'msg'=>'Product Is  Created !!','url'=>route('admin.products.index')]);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
    }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('sizes','sizes.stocks')->find($id);
        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('product.edit'))
        {
            abort(403, 'unauthorized');
        }

        $item=Product::with('sizes')->find($id);
        $cats=Category::whereNull('parent_id')->get();
        $sizes=Size::all();
        $types=Type::all();
        $colors=Color::all();
        $weights=Weight::all();

        $subs=Category::where('parent_id', $item->category_id)->get();

        return view('backend.products.edit', compact('item','cats','sizes','types','subs','colors','weights'));
    }
  
  	public function productCopy($id){
    	$item=Product::with('sizes')->find($id);
        $cats=Category::whereNull('parent_id')->get();
        $sizes=Size::all();
        $types=Type::all();
        $colors=Color::all();

        $subs=Category::where('parent_id', $item->category_id)->get();
      	return view('backend.products.copy', compact('item','cats','sizes','types','subs','colors'));
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

        if(!auth()->user()->can('product.edit'))
        {
            abort(403, 'unauthorized');
        }

        $product=Product::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'category_id'=> 'required',
             'sub_category_id'=> '',
             'type_id'=> '',
             'description'=> '',
             'body'=> '',
             'feature'=> '',
             'sku'=> '',
             'purchase_price'=> '',
             'regular_price'=> '',
             'sell_price'=> 'required|numeric',
             'is_stock' => ''
        ]);


    DB::beginTransaction();

        try {

        if($request->hasFile('image')) {
            deleteImage('products', $product->image);
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('products'), $fileName);
            $data['image']=$fileName;
        }

        
        if(isset($request->images)) {
            $image_data=[];
            $fileName='';
            foreach ($request->images as $key => $image) {
                $originName = $image->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileName =$fileName.time().'.'.$extension;
            
                $image->move(public_path('products'), $fileName);
                $image_data[]=['image'=>$fileName];
            }

            if (!empty($image_data)) {
                $product->images()->createMany($image_data);
            }
            
        }

    
        $product->update($data);

        $delete_variations=Variation::where('product_id',$id)->whereNotIn('id',$request->variation_id)->get();

        if ($delete_variations->count()) {
            foreach ($delete_variations as $key => $dvariation) {
                $dvariation->delete();
            }
        }           


        if (isset($request->size_id)) {

            $variable_data=[];
            foreach ($request->size_id as $key => $size) {

                if (isset($request->variation_id[$key])) {
                    $variable=Variation::find($request->variation_id[$key]);
                    $variable->size_id=$size;
                    $variable->color_id=$request->color_id[$key];
                    $variable->weight_id=$request->weight_id[$key];
                    $variable->price=$request->price[$key];
                    $variable->save();
                }else{
                    $variable_data[]=[
                        'size_id'=>$size,
                        'color_id'=>$request->color_id[$key],
                        'weight_id'=>$request->weight_id[$key],
                        'price'=>$request->price[$key],
                    ];
                }
            }

            if (!empty($variable_data)) {
                $product->variations()->createMany($variable_data);
            }           
            
        }
    
        DB::commit();
        return response()->json(['status'=>true ,'msg'=>'Product Is Updated !!','url'=>route('admin.products.index')]);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
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
        if(!auth()->user()->can('product.delete'))
        {
            abort(403, 'unauthorized');
        }
    DB::beginTransaction();

        try {

        $product=Product::find($id);
        deleteImage('products', $product->image);
        deleteImage('products', $product->optional_image);

        if ($product->images()->count()) {
            
            foreach ($product->images as $key => $image) {
                deleteImage('products', $image->image);
            }
            $product->images()->delete();
        }

        foreach ($product->variations as $key => $dvariation) {
            $dvariation->delete();
        }
        $product->delete();
        DB::commit();
        return response()->json(['status'=>true ,'msg'=>'Product Is Deleted !!']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
    }
        

    }

    public function deleteImage($id){

        $item=ProductImage::find($id);
        deleteImage('products', $item->image);
        $item->delete();
        return back();
    }

    public function fileUpload(Request $request){

        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('ck-images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('ck-images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }

    }
    
    public function recommendedUpdate (){
        
        $status=(request('is_recommended')==1)?1:null;
        DB::table('products')->whereIn('id', request('product_ids'))->update(['is_recommended'=>$status]);
        return response()->json(['status'=>true ,'msg'=>'Product Status Updated !!']);
    }
    
}
