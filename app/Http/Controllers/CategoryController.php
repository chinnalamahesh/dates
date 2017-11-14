<?php
namespace App\Http\Controllers;
use Validator;
use Redirect;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Session;
use File;
class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	/* public function user_action(){
		$uid=access()->id();
		$user_detais = DB::table('users')->select('*')->where('id',$uid)->first(); 
		return $org_id=$user_detais->org_id;
	} */
	public function index()
    { 
	     // $org_id=$this->user_action();
        $categorys = DB::table('ex_categories')->select('*')->whereNULL('deleted_at')->orderBy('updated_at','DESC')->Paginate(15); 
		return view('\categorys.index')->with('categorys', $categorys);
    }
        
	public function create(){
	       return view('\categorys.create');
	}
	public function store()
    {

    	  $name=Input::get('pname');
    	echo $name;
		//$org_id=$this->user_action();
		$cat_details = DB::table('ex_categories')->select('*')->whereNULL('deleted_at')->where('name',$name)->first(); 
		
	  	if(count($cat_details)>0){
		  Session::flash('error_message', 'Category Already Exist.');
          return Redirect::to('categorys')->withInput(Input::all());
		}
		
        $rules = array(
            'pname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('categorys')
                ->withErrors($validator)
                ->withInput(Input::all());
        } 
        else {
									
			 $category = new Category;
			 $category->name = Input::get('pname');
			 $category->org_id = 1;
     		 $category->status = 1;
			 $category->created_by = 1;//Auth::user()->id;
			 $category->modified_by = 1; //Auth::user()->id;
			 $category->save();
			 Session::flash('message', 'New Category Created Successfully.');
            return Redirect::to('categorys');
	}	 
    }
   
	public function update()
    { 
	    $id=Input::get('id');
		$name=Input::get('cname');
			//	$org_id=$this->user_action();
		$cat_details =  DB::table('ex_categories')->select('*')->whereNULL('deleted_at')->where('name',$name)->first(); 
		
	  	if(count($cat_details)>0 && ($cat_details->id != $id)){
		  Session::flash('error_message', 'Category Name Already Exist.');
          return Redirect::to('categorys/')->withInput(Input::all());
		}

         $rules = array(
            'cname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
	
            return Redirect::to('categorys/')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
			
			 $category = Category::find($id);
			 $category->name = Input::get('cname');
			 $category->org_id = 1;
     		 $category->status = Input::get('status');
			 $category->modified_by = 1; //Auth::user()->id;
			 $category->save();
			 Session::flash('message', 'Category Updated Successfully.');
             return Redirect::to('/categorys/');
		} 
    }
	public function destroy($id)
    {
         $cate = Category::find($id);
		$cate->delete();
		Session::flash('message', 'Category Deleted Successfully.'); 
    }
}
