<!DOCTYPE html>
<html>
<head>
 <!--JQuery Date picker- ->
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script> 
$(function() { 
$( "#datepicker" ).datepicker(); 
}); 
</script> 
<!--JQuery Date picker-->
   <style>
 .input-group { width: 100px; }

  span.input-group-btn { float: left; }

 .btn-default { color: #fff !important; background-color: green !important; border-color: yellow !important; }
</style>

<title>Expands</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>


	<div class="container">
		<form action="/search" method="POST" role="search">
			{{ csrf_field() }}
			<div class="input-group">

			        Starting Date:<input type="date" class="form-control" name="start_date"
					placeholder="Starting Date" id="datepicker"><br /> 

                    Ending Date:<input type="date" class="form-control" name="end_date"
                    placeholder="Ending Date"><br />

                    Starting Time:<input type="text" class="form-control" name="start_time"
                    placeholder="Starting Time"><br /> 

                    Ending Time:<input type="text" class="form-control" name="end_time"
                    placeholder="Ending Time"><br />

                    <span class="input-group-btn">
					<button type="submit" class="btn btn-default">
						<span class="glyphicon glyphicon-search"> Search</span>
					</button>
				</span>
			</div>
		</form>
	</div>	

		<div class="container">
			@if(isset($details))
			<p> The Search results for your query <b> {{ $query }} </b> are :</p>
			<h2>Expands Searching</h2>
               <table class="table table-striped">
				<thead>
					<tr>
						<th>Class Name</th>
						<th>Location Name</th>
						<th>Class Start Date</th>
                        <th>Class End Date</th>
                        <th>Class Start Time</th>
                        <th>Class End Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach($details as $class)
					<tr>
						<td>{{$class->cls_name}}</td>
						<td>{{$class->location_name}}</td>
						<td>{{$class->cls_start_date}}</td>
                        <td>{{$class->cls_end_date}}</td>
                        <td>{{$class->cls_start_time}}</td>
                        <td>{{$class->cls_end_time}}</td>
                    </tr>
					@endforeach
				</tbody>
			</table> 
			
			@if($details){!! $details->render() !!}@endif
			@elseif(isset($message))
			<p>{{ $message }}</p>
			@endif
		</div>

</body>
</html>