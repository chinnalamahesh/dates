<?php
namespace App\Http\Controllers;
use Validator;
use Redirect;
use App\Color;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Session;
use File;
class ColorsController extends Controller
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
        $colors = DB::table('ex_colors')->select('*')->whereNULL('deleted_at')->orderBy('updated_at','DESC')->Paginate(15); 
		return view('\colors.index')->with('colors', $colors);
    }
        
	public function create(){
	       return view('\colors.create');
	}
	public function store()
    {

    	  $name=Input::get('pname');
    	echo $name;
		//$org_id=$this->user_action();
		$cat_details = DB::table('ex_colors')->select('*')->whereNULL('deleted_at')->where('name',$name)->first(); 
		
	  	if(count($cat_details)>0){
		  Session::flash('error_message', 'Color Already Exist.');
          return Redirect::to('colors')->withInput(Input::all());
		}
		
        $rules = array(
            'pname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('colors')
                ->withErrors($validator)
                ->withInput(Input::all());
        } 
        else {
									
			 $color = new Color;
			 $color->name = Input::get('pname');
			 $color->org_id = 1;
     		 $color->status = 0;
			 $color->created_by = 1;//Auth::user()->id;
			 $color->modified_by = 1; //Auth::user()->id;
			 $color->save();
			 Session::flash('message', 'New Color Created Successfully.');
            return Redirect::to('colors');
	}	 
    }
   
	public function update()
    { 
	    $id=Input::get('id');
		$name=Input::get('cname');
		//	$org_id=$this->user_action();
		$cat_details =  DB::table('ex_colors')->select('*')->whereNULL('deleted_at')->where('name',$name)->first(); 
		
	  	if(count($cat_details)>0 && ($cat_details->id != $id)){
		  Session::flash('error_message', 'Color Name Already Exist.');
          return Redirect::to('colors/')->withInput(Input::all());
		}

         $rules = array(
            'cname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
	
            return Redirect::to('colors/')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
			
			 $color = Color::find($id);
			 $color->name = Input::get('cname');
			 $color->org_id = 1;
     		 $color->status = Input::get('status');
			 $color->modified_by = 1; //Auth::user()->id;
			 $color->save();
			 Session::flash('message', 'Color Updated Successfully.');
             return Redirect::to('/colors/');
		} 
    }
	public function destroy($id)
    {
         $color = Color::find($id);
		$color->delete();
		Session::flash('message', 'Color Deleted Successfully.'); 
    }
}