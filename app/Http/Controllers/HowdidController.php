<?php
namespace App\Http\Controllers;
use Validator;
use Redirect;
use App\Howdid;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Session;
use File;
class HowdidController extends Controller
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
        $howdid = DB::table('ex_howdid')->select('*')->whereNULL('deleted_at')->orderBy('updated_at','DESC')->Paginate(15); 
		return view('\howdid.index')->with('howdid', $howdid);
    }
        
	public function create(){
	       return view('\howdid.create');
	}
	public function store()
    {

    	  $name=Input::get('pname');
    	echo $name;
		//$org_id=$this->user_action();
		$cat_details = DB::table('ex_howdid')->select('*')->whereNULL('deleted_at')->where('name',$name)->first(); 
		
	  	if(count($cat_details)>0){
		  Session::flash('error_message', 'Color Already Exist.');
          return Redirect::to('howdid')->withInput(Input::all());
		}
		
        $rules = array(
            'pname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('howdid')
                ->withErrors($validator)
                ->withInput(Input::all());
        } 
        else {
									
			 $howdid = new Howdid;
			 $howdid->name = Input::get('pname');
			 $howdid->org_id = 1;
     		 $howdid->status = 1;
			 $howdid->created_by = 1;//Auth::user()->id;
			 $howdid->modified_by = 1; //Auth::user()->id;
			 $howdid->save();
			 Session::flash('message', 'New Created Successfully.');
            return Redirect::to('howdid');
	}	 
    }
   
	public function update()
    { 
	    $id=Input::get('id');
		$name=Input::get('cname');
		//	$org_id=$this->user_action();
		$cat_details =  DB::table('ex_howdid')->select('*')->whereNULL('deleted_at')->where('name',$name)->first(); 
		
	  	if(count($cat_details)>0 && ($cat_details->id != $id)){
		  Session::flash('error_message', 'Name Already Exist.');
          return Redirect::to('howdid/')->withInput(Input::all());
		}

         $rules = array(
            'cname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
	
            return Redirect::to('howdid/')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
			
			 $howdid = Howdid::find($id);
			 $howdid->name = Input::get('cname');
			 $howdid->org_id = 1;
     		 $howdid->status = Input::get('status');
			 $howdid->modified_by = 1; //Auth::user()->id;
			 $howdid->save();
			 Session::flash('message', 'Updated Successfully.');
             return Redirect::to('/howdid/');
		} 
    }
	public function destroy($id)
    {
         $howdid = Howdid::find($id);
		$howdid->delete();
		Session::flash('message', 'Deleted Successfully.'); 
    }
}