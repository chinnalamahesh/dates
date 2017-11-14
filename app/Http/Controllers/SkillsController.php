<?php
namespace App\Http\Controllers;
use Validator;
use Redirect;
use App\Skill;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Session;
use File;
class SkillsController extends Controller
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
        $skills = DB::table('ex_skills')->select('*')->whereNULL('deleted_at')->orderBy('updated_at','DESC')->Paginate(15); 
		return view('\skills.index')->with('skills', $skills);
    }
        
	public function create(){
	       return view('\skills.create');
	}
	public function store()
    {

    	  $skill=Input::get('pname');
    	echo $skill;
		//$org_id=$this->user_action();
		$cat_details = DB::table('ex_skills')->select('*')->whereNULL('deleted_at')->where('skill',$skill)->first(); 
		
	  	if(count($cat_details)>0){
		  Session::flash('error_message', 'Already Exist.');
          return Redirect::to('skills')->withInput(Input::all());
		}
		
        $rules = array(
            'pname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('skills')
                ->withErrors($validator)
                ->withInput(Input::all());
        } 
        else {
									
			 $skill = new Skill;
			 $skill->skill = Input::get('pname');
			 $skill->org_id = 1;
     		 $skill->status = 0;
			 $skill->created_by = 1;//Auth::user()->id;
			 $skill->modified_by = 1; //Auth::user()->id;
			 $skill->save();
			 Session::flash('message', 'New Color Created Successfully.');
            return Redirect::to('skills');
	}	 
    }
   
	public function update()
    { 
	    $id=Input::get('id');
		$skill=Input::get('cname');
		//	$org_id=$this->user_action();
		$cat_details =  DB::table('ex_skills')->select('*')->whereNULL('deleted_at')->where('skill',$skill)->first(); 
		
	  	if(count($cat_details)>0 && ($cat_details->id != $id)){
		  Session::flash('error_message', 'Already Exist.');
          return Redirect::to('skills/')->withInput(Input::all());
		}

         $rules = array(
            'cname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
	
            return Redirect::to('skills/')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
			
			 $skill = Skill::find($id);
			 $skill->skill = Input::get('cname');
			 $skill->org_id = 1;
     		 $skill->status = Input::get('status');
			 $skill->modified_by = 1; //Auth::user()->id;
			 $skill->save();
			 Session::flash('message', 'Color Updated Successfully.');
             return Redirect::to('/skills/');
		} 
    }
	public function destroy($id)
    {
         $skill = Skill::find($id);
		$skill->delete();
		Session::flash('message', 'Color Deleted Successfully.'); 
    }
}