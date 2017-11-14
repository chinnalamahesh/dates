<?php
use Carbon\Carbon;
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Classs;
use Illuminate\Support\Facades\Input;

class DateClassController extends Controller
{

public function index()
    {

  /*  $current = Carbon::now();
 
    return $current;*/

	return view('classes.index');

	}

public function search()
{

	$dummyDetails = Classs::paginate(15);
	return view ( 'classes.index' )->withClasss($dummyDetails);

}




/*-----------------------------------------------Date Search------------------------------------*/

public function searchdata()
{

 $start_date = Input::get ( 'start_date' );
		if($start_date !=""){
	$classs = classs::where ( 'cls_start_date', 'LIKE', '%' . $start_date .'%' )->orWhere ( 'cls_start_date', 'LIKE', '%' . $start_date . '%' )->paginate (15);

     	$pagination = $classs->appends ( array (
				
				'start_date' => Input::get ( 'start_date' )

		) );
	if (count ( $classs ) > 0)
	
	    return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $start_date );

	}



	$end_date = Input::get ( 'end_date' );
		if($end_date !=""){
	$classs = Classs::where ( 'cls_name', 'LIKE', '%' . $end_date .'%' )->orWhere ( 'cls_end_date', 'LIKE', '%' . $end_date . '%' )->paginate (15);

	
     	$pagination = $classs->appends ( array ('end_date' => Input::get ( 'end_date' )) );
	if (count ( $classs ) > 0)
	
	    return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $end_date );

	}
	


    $start_time = Input::get ( 'start_time' );
		if($start_time !=""){
	$classs = Classs::where ( 'cls_name', 'LIKE', '%' . $start_time .'%' )->orWhere ( 'cls_start_time', 'LIKE', '%' . $start_time . '%' )->paginate (15);

     	$pagination = $classs->appends ( array (
				
				'start_time' => Input::get ( 'start_time' )

			
											
		) );
	if (count ( $classs ) > 0)
	
	    return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $start_time );

	}
	
    $end_time = Input::get ( 'end_time' );
		if($end_time !=""){
	$classs = Classs::where ( 'cls_name', 'LIKE', '%' . $end_time .'%' )->orWhere ( 'cls_end_time', 'LIKE', '%' . $end_time . '%' )->paginate (15);

     	$pagination = $classs->appends ( array (
				
				'end_time' => Input::get ( 'end_time' )

			
											
		) );
	if (count ( $classs ) > 0)
	
	    return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $end_time );

	}
		return view ( 'classes.index' )->withMessage ( 'No Details found. Try to search again !' );

}



/*--------------------------[Testode]--------------------------------------* /

public function testsearch()
{
$start_date = Input::get ( 'start_date' );
$end_date = Input::get ( 'end_date' );

//$now = Carbon::now();
 /*$date = Carbon::now();*/ 
    /*return $current;* /
		if($start_date !="" && $end_date  !=""){

$classs = Classs::where ( 'cls_start_date', 'LIKE', '%' . $start_date .'%' )->orWhere ( 'cls_start_date', 'LIKE', '%' . $start_date . '%' )->orWhere ( 'cls_end_date', 'LIKE', '%' . $end_date . '%' )->paginate(15);

/*
$classs = Classs::where('cls_start_date', '<' Carbon::now())->where('cls_end_time', '>' Carbon::now());* /
     	$pagination = $classs->appends ( array (
				
				'start_date' => Input::get ( 'start_date' ),
                'end_date' => Input::get ( 'end_date' ),
			    'start_time' => Input::get ( 'start_time' ),
			    'end_time' => Input::get ( 'end_time' )
											
		) );
	if (count ( $classs ) > 0)
	
	    return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $start_date );
        return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $end_date );
       return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $start_time );
        return view ( 'classes.index' )->withDetails ( $classs )->withQuery ( $end_time );
	}
		return view ( 'classes.index' )->withMessage ( 'No Details found. Try to search again !' );


}

/*public function simple()

{
	$now = Carbon::now();

$start_date = Carbon::parse($request->input('cls_start_date'));

$end_date = Carbon::parse($request->input('cls_end_date'));

if($now->between($start_date,$end_date))
{
    echo 'Coupon is Active';
}
 else 
{
    echo 'Coupon is Expired';
}


}
/*
"SELECT * FROM logs WHERE date BETWEEN '" . $from_date . "' AND  '" . $to_date . "'
ORDER by id DESC"



public function searchCustomers(Request $request, Classs $classs)
{
    $start_date = $request->get('cls_start_date');
    $end_time = $request->get('cls_end_time');
    $classs = $classs->newQuery();

    if ($request->has('cls_start_date')) {
        $classs->where('cls_start_date', $request->input('start_date'));
    }

    if (!empty($start_date) && !empty($end_time)) {
        $classs->whereBetween('date_of_visit', [$start_date, $end_time]);
    } else if(!empty($fromDate)){
        $classs->where('cls_start_date', '>=', $start_date);
    } else {
        $classs->where('cls_end_time', '<=', $end_time);
    }
    $results = $classs->get();

    return response()->json($results);
}
*/

}
