<?php
namespace App\Http\Controllers;
use Validator;
use Redirect;
use App\Epayment;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Session;
use File;
class EpaymentsController extends Controller
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
        $epayments = DB::table('ex_epayments')->select('*')->whereNULL('deleted_at')->orderBy('updated_at','DESC')->Paginate(15); 
		return view('\epayments.index')->with('epayments', $epayments);
    }
        
	public function create(){
	       return view('\epayments.create');
	}
	public function store()
    {

    	  $e_payments=Input::get('pname');
    	echo $e_payments;
		//$org_id=$this->user_action();
		$cat_details = DB::table('ex_epayments')->select('*')->whereNULL('deleted_at')->where('e_payments',$e_payments)->first(); 
		
	  	if(count($cat_details)>0){
		  Session::flash('error_message', 'Already Exist.');
          return Redirect::to('epayments')->withInput(Input::all());
		}
		
        $rules = array(
            'pname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('epayments')
                ->withErrors($validator)
                ->withInput(Input::all());
        } 
        else {
									
			 $epayment = new Epayment;
			 $epayment->e_payments = Input::get('pname');
			 $epayment->org_id = 1;
     		 $epayment->status = 1;
			 $epayment->created_by = 1;//Auth::user()->id;
			 $epayment->modified_by = 1; //Auth::user()->id;
			 $epayment->save();
			 Session::flash('message', 'New Created Successfully.');
            return Redirect::to('epayments');
	}	 
    }
   
	public function update()
    { 
	    $id=Input::get('id');
		$e_payments=Input::get('cname');
			//	$org_id=$this->user_action();
		$cat_details =  DB::table('ex_epayments')->select('*')->whereNULL('deleted_at')->where('e_payments',$e_payments)->first(); 
		
	  	if(count($cat_details)>0 && ($cat_details->id != $id)){
		  Session::flash('error_message', 'Already Exist.');
          return Redirect::to('epayments/')->withInput(Input::all());
		}

         $rules = array(
            'cname'       => 'required'
            
        );
		$validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
	
            return Redirect::to('epayments/')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
			
			 $epayment = Epayment::find($id);
			 $epayment->e_payments = Input::get('cname');
			 $epayment->org_id = 1;
     		 $epayment->status = Input::get('status');
			 $epayment->modified_by = 1; //Auth::user()->id;
			 $epayment->save();
			 Session::flash('message', 'Updated Successfully.');
             return Redirect::to('/epayments/');
		} 
    }
	public function destroy($id)
    {
        $cate = Epayment::find($id);
		$cate->delete();
		Session::flash('message', 'Payment Deleted Successfully.'); 
    }
}
