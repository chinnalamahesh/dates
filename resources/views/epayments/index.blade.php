<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>E Payments Schedules</title>s
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    {{-- <link rel="styleeheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">
    {{-- <link rel="stylesheet" href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css"> --}}

    <!-- toastr notifications -->
    {{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  
  <script>
  // When the browser is ready...
  $(function() {
  
  $(".edit_form").validate({
   });
    $(".add_form").validate({
   });
  });
  
  function deleteepayments(id) {
              if (confirm('Are you sure you want to delete?')) {
                                       $.ajax({
                                           type: "GET",
                                           url: "{{ URL::to('epayments/delete') }}" + "/" + id,
                                           success: function(message) {
                                               window.location.href = "{{ URL::to('epayments') }}";
                                           }
                                        });
        }
                        
              
       }
  </script>
  
  
    <style>
        .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
    </style>
</head>

<body>
    <div class="col-md-8 col-md-offset-2">
        <h2 class="text-center">E Payments Schedules</h2>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul>
                    <li><i class="fa fa-file-text-o"></i> E Payments Schedules</li>
                    <a href="#" data-toggle="modal" data-target="#modal-add"><li>Add a Payment</li></a>
                </ul>
            </div>
        
            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                 <th>E Payment</th>
                                 <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                             @foreach ($epayments as $epayment)  
                                <tr class="item{{$epayment->id}}">
                                      <td>{{$epayment->e_payments}}</td>
                    <td><?php if($epayment->status=='1'){ $cls="label label-primary";
          $cls_data="Active";}else{
          $cls="label label-warning"; $cls_data="Inactive"; }
          ?><span class="<?php echo $cls;?>">{{  $cls_data }}</span></td>
                         <td>       
                        <a data-toggle="modal" data-target="#editstack{{ $epayment->id }}" href="#">  <i class="fa fa-fw fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i> </a> 
                        <a id="delete_mgp" href="javascript:deleteepayments({{ $epayment->id }});" > <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
             <?php 
          $id=$epayment->id;
               $cat_details = DB::table('ex_epayments')->select('*')->whereNULL('deleted_at')->where('id',$id)->first();
    
          ?>
           <div class="modal fade" id="editstack{{ $epayment->id }}" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Edit  - {{ $cat_details->e_payments }}</h4>
                </div>

    <form action="<?php echo url('epayments/update');?>" method="post" class="form-horizontal edit_form">
  <input type="hidden" name="id" id="id" class="form-control" value="{{ $cat_details->id }}">
                <div class="modal-body">
                   {{ csrf_field() }}
   <div class="row" style="margin:0px 0px 0px 0px !important;">
  <div class="col-md-3">
   
   <label class="control-label">E Payments <span class="required" aria-required="true">* </span></label>  
  </div>
  <div class="col-md-9">
  <input type="text" name="cname" id="e_payments" class="form-control required" value="{{ $cat_details->e_payments }}">

<!-- <select id="e_payments" name="cname" class="form-control" aria-invalid="false" value="{{ $cat_details->e_payments }}">
<option selected="selected"></option>
<option value="15th of Month">15th of Month</option>
<option value="1st of Month">1st of Month</option>
<option value="Monthly">Monthly</option>
<option value="Quarterly">Quarterly</option>
<option value="Weekly">Weekly</option>
</select>-->

  </div>
   </div>
    <br />
  <div class="row" style="margin:10px 0px 0px 0px !important;">
  <div class="col-md-3">
      <label class="control-label">Status
       </label>  
  </div><div class="col-md-9 input_container">
<select id="status" name="status" class="form-control">
<option value="1" <?php if($cat_details->status == '1'){ echo "selected";}?>>Active</option>
<option value="0" <?php if($cat_details->status == '0'){ echo "selected";}?>>Inactive</option>
</select>
 </div>
  </div><br /> 
                  <div class="row">
                    <div class="col-md-3">
                      <p>&nbsp; </p>
                    </div>
                                        <div class="col-md-9"><input type="submit" name="update" value="Update">
                      
                      &nbsp; <a href="#" class="btn btn-default btn red" data-dismiss="modal" aria-hidden="true">Cancel</a> </div>
                  </div>
                </div>
                </form>
                </div>
            </div>
          </div>
                  
          </td>
                                  
                                </tr>
                          @endforeach
                        </tbody>
                    </table>
            </div><!-- /.panel-body -->
        </div><!-- /.panel panel-default -->
    </div><!-- /.col-md-8 -->

    <!-- Modal form to add a payment -->
       <div class="modal fade" id="modal-add">
         <div class="modal-dialog">
          <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
              
      <div class="modal-body">
            <form action="<?php echo url('epayments/create');?>" method="post" class="form-horizontal add_form"> 
              
         {{ csrf_field() }}
          <div class="row" style="margin:0px 0px 0px 0px !important;">
          <div class="col-md-3">

          <label class="control-label">E payment <span class="required" aria-required="true">* </span></label>  </div>
<!--Payment select-->
<div class="col-md-9">
<input type="text" name="pname" id="pname" class="form-control required" value="{{ old('pname') }}">

<!--<select id="pname" name="pname" class="form-control required" aria-invalid="false" value="{{ old('pname') }}">>
<option selected="selected"></option>
<option value="15th of Month">15th of Month</option>
<option value="1st of Month">1st of Month</option>
<option value="Monthly">Monthly</option>
<option value="Quarterly">Quarterly</option>
<option value="Weekly">Weekly</option>
</select>-->
</div>
<!--</div>-->

<!--Payment Select-->

         
          </div>
          <br />
          
          <div class="row">
          <div class="col-md-3">
          <p>&nbsp; </p>
          </div>
          <div class="col-md-9"> <input type="submit" name="save" value="Save" class="btn btn-primary" id="btn-validate">

          &nbsp; <a href="#" class="btn btn-default btn red" data-dismiss="modal" aria-hidden="true">Cancel</a> </div>
          </div>
          
              
             </form>
            </div>
        </div>
      </div>
    </div>



  

    <!-- jQuery -->
    {{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    {{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="{{ asset('icheck/icheck.min.js') }}"></script>

    <!-- Delay table load until everything else is loaded -->
   

</body>
</html>