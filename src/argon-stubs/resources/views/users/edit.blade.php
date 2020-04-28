@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit User')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update', $user) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

//expenses index

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Pending Expense List</h2>
    <div class="pull-right">
      
        <a class="btn btn-success" style="color: white !important" href="{{ route('expenses.create') }}"> Create New Expense</a>

        <a class="btn btn-warning" style="color: white !important;" href="{{ route('home') }}"> Back</a>
                    
        </div>
        <div class="clearfix"></div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
      </div>
      <div class="x_content">      <!--  table-striped table-bordered -->
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table " style="font-size:12px;width:100% !important">
              <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>UserName</th>
                      <th>Category</th>
                      <th>Currency</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach ($datas as $expense)
                    
            <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $expense->title }}</td>
            <td>{{ $expense->price }}</td>
            <td>
                            @if($expense->name)
                  <label class="badge badge-success">{{ $expense->name }}</label>
                            @else
                              <label class="badge badge-success">{{ $expense->user->name }}</label>   
                            @endif
                        </td>
            <td>{{ $expense->category_name }}</td>
                        <td>{{ $expense->currency_name }}</td>
            <td>
               <a class="btn btn-info" style="color: white !important" href="{{ route('expenses.show',$expense->expenseId) }}">Show</a>
              
            
               <a class="btn btn-primary" style="color: white !important" href="{{ route('expenses.edit',$expense->expenseId) }}">Edit</a>
             
           
              <a class="btn btn-success" style="color: white !important" href="{{ url('expenses/'.$expense->expenseId.'/expenseapproved') }}">Approved</a>
            
              <a class="btn btn-warning" style="color: white !important" href="{{ url('expenses/'.$expense->expenseId. '/expensereject') }}">Reject</a>
           
              {!! Form::open(['method' => 'DELETE','route' => ['expenses.destroy', $expense->expenseId], 'onClick'=>"return confirm('Are you sure you want to delete?')", 'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
           
            </td>
            </tr>
           @endforeach      
              </tbody>
              <tfoot>
                    <tr> 
            <th>S.No</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>UserName</th>
                      <th>Category</th>
                      <th>Currency</th>
                      <th>Action</th>
                  </tr>
              </tfoot>
          </table>                              
        </div>
</div>
{!! $datas->render() !!}        
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>
   
@endsection

//expense show 

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <div class="pull-left">
            <h2>Show Expense</h2>
        </div>
        <div class="pull-right">
            
                <a class="btn btn-success" style="color: white !important" href="{{ route('expenses.index') }}"> Back</a>
           
        </div>
        <div class="clearfix"></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
      </div>
      <div class="x_content">     
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
          
              <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $expense->title }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $expense->price }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User:</strong>
                            <label class="badge badge-success">{{ $expense->user->name }}</label>
                        </div>
                    </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category:</strong>
                            {{ $expense->category_name }}
                        </div>
                    </div>
                    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Currency:</strong>
                            {{ $expense->currency_name }}
                        </div>
                    </div> -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Date:</strong>
                            {{ $expense->date }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Time:</strong>
                            {{ $expense->time }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>Attachments:</strong>
                        <div class="form-group"> 
                                
                                @foreach($attachments as $files) 
                                     @if($files['attach_link'])   
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                          <img src="{{ $files['attach_link'] }}" style="max-width:100px; max-height:100px">
                                        </div>
                                    @else
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                              No Image Found.
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                      </div>
                </div>
                
          </table>                              
    </div>
</div>     
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

@endsection


//expense edit


@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="pull-left">
                        <h2>Edit Expense</h2>
                    </div>
                    <div class="pull-right">
                       
                            <a class="btn btn-success" style="color: white !important" href="{{ route('expenses.index') }}"> Back</a>
                       
                    </div>
                    <div class="clearfix"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                  </div>
                  <div class="x_content">
                    <br>
                  {{ csrf_field() }}    
                  
                      <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
                      
                        {!! Form::model($expense, ['method' => 'PATCH', 'enctype' => 'multipart/form-data' ,'route' => ['expenses.update', $expense->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'required')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control', 'required')) !!}
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Category:</strong>
                                    <select class="form-control" name="category"  required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}" {{$expense->category_id == $category['id']  ? 'selected' : ''}}>{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Currency:</strong>
                                    <select class="form-control" name="currency"  required>
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency['id'] }}" {{$expense->category_id == $category['id']  ? 'selected' : ''}}>{{ $currency['currency_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Date:</strong>
                                    {!! Form::date('date', null , array('placeholder' => 'Date' ,'class' => 'form-control', 'required')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Time:</strong>
                                    <div class="input-group clockpicker">
                                        {!! Form::text('time', '18:00' , array('placeholder' => 'Time' ,'class' => 'form-control', 'required')) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Attachments:</strong>
                                <div class="form-group" style= "margin-top: 5px;"> 
                                        {!! Form::file('image[]') !!}
                                        @foreach($attachments as $files) 
                                             @if($files['attach_link'])   
                                                <div class="col-md-6 col-sm-6 col-xs-6" style= "margin-top: 5px;">
                                                  <img src="{{ $files['attach_link'] }}" style="max-width:100px; max-height:100px">
                                                </div>
                                            @else
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                      No Image Found.
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                             </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style= "margin-top: 5px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        
                      </table>
                  </div>
                </div>
              </div>
</div>


<style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
</style>
<script type="text/javascript">
        $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            donetext: 'Done'
        });
    </script>
@endsection

//expense reject

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')

<div class="right_col" role="main">
@include('layout/flash')
  <div class="col-md-12 col-xs-12">
                <div class="pull-right">
                        @can('expense-create')
                            <a class="btn btn-success" style="color: white !important;" href="{{ route('expenses.index') }}"> Back</a>
                        @endcan
                    </div>
                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" href="#main">Main</a></li>
                    <li class="active"><a data-toggle="tab" href="#gallery">Notification</a></li>
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane fade in">
                        <div class="x_panel">
                          <div class="x_title">
                              @foreach($username as $name)
                            <h2>UserName: <small>{{$name->name}}</small></h2>
                            @endforeach
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <br>
                            <form class="form-horizontal form-label-left" action="" method="POST" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              
                              <div class="form-group">
                              <label for="content" class="col-sm-12" style="float:left">Username</label>
                              </div>
                              <div class="form-group">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control" placeholder="Username" type="text" name="username" value="{{$name->name}}">
                              </div>
                              </div>
                              
                              <div class="form-group">
                              <label for="content" class="col-sm-12" style="float:left">Email</label>
                              </div>
                              <div class="form-group">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <input class="form-control" placeholder="Email" type="text" name="email" value="{{$name->email}}">
                              </div>
                              </div>
        
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                  <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/') }}/expenses'">Cancel</button>
                                  <button type="reset" class="btn btn-primary">Reset</button>
                                  <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                              </div>
        
                            </form>
                            
                          </div>
                        </div>
                        
                    </div>
                    <div id="gallery" class="tab-pane fade in active">
                        <form>
                          <div class="x_content">   
                            
                            <div id="ajaxGetNotification">
                              
                            </div>
                            <div class="form-group">
                              <label for="content" class="col-sm-12" style="float:left">Message List</label>
                            </div>
                            @if(count($message)>0)
                            <div class="form-group" style="padding-bottom:20px">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="message_list" class="form-control" id="messageList">
                                    <option value="0">--Select Message--</option>
                                    @foreach($message as $k=>$v)
                                        <option value="{{$v->id}}">{{$v->title}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            @endif
                            <div class="form-group">
                              <label for="content" class="col-sm-12" style="float:left">Notifications</label>
                            </div>
                            <div class="form-group" style="padding-bottom:80px">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <textarea class="form-control" rows="5" placeholder="Notification" id="booking_msg" name="booking_msg"></textarea>
                              </div>
                            </div>
                            
                              
                              <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                   <input type="hidden" id="booking_id" name="booking_id" value="{{$id}}">
                                   <br>
                                  <button type="button" id="sendNotification" class="btn btn-success">Sent Notification</button>
                                </div>
                              </div>
                              </form>
                          </div>
                         
                         
                    </div>
                </div>
 
</div>


//inventory index


@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Inventory List</h2>
    <div class="pull-right">
      
        <a class="btn btn-success" style="color: white !important" href="{{ route('inventory.create') }}"> Create New Inventory</a>
           
            <a class="btn btn-warning" style="color: white !important;" href="{{ route('home') }}"> Back</a>
        </div>

        <div class="clearfix"></div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
      </div>
      <div class="x_content">      <!--  table-striped table-bordered -->
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table " style="font-size:12px;width:100% !important">
              <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Category Name</th>
                      <th>SubCategory Name</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach ($datas as $inventory)
                    
            <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $inventory->item_name }}</td>
            <td>{{ $inventory->quantity }}</td>
            <td>                         
                <label class="badge badge-success">{{ $inventory->price }}</label>
            </td>
            <td>{{ \App\InventoryCategory::where(['parent_id' => $inventory->category_id])->pluck('name')->first() }}</td>
           
            <td>{{ \App\InventoryCategory::where(['id' => $inventory->subcategory_id])->pluck('name')->first() }}</td>
            <td>
               <a class="btn btn-info" style="color: white !important" href="{{ route('inventory.show',$inventory->id) }}">Show</a>
              
             
               <a class="btn btn-primary" style="color: white !important" href="{{ route('inventory.edit',$inventory->id) }}">Edit</a>
          
              {!! Form::open(['method' => 'DELETE','route' => ['inventory.destroy', $inventory->id], 'onClick'=>"return confirm('Are you sure you want to delete?')", 'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
           
            </td>
            </tr>
           @endforeach      
              </tbody>
              <tfoot>
                    <tr> 
            <th>S.No</th>
                      <th>Item Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Category Name</th>
                      <th>SubCategory Name</th>
                      <th>Action</th>
                  </tr>
              </tfoot>
          </table>                              
        </div>
</div>
   {!! $datas->render() !!}
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

@endsection

//inventory show

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <div class="pull-left">
            <h2>Show Inventory</h2>
        </div>
        <div class="pull-right">
            @can('inventory-create')
                <a class="btn btn-success" style="color: white !important;" href="{{ route('inventory.index') }}"> Back</a>
            @endcan
        </div>
        <div class="clearfix"></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
      </div>
      <div class="x_content">     
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
          
              <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Item Name:</strong>
                            {{ $inventory->item_name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Serial Number:</strong>
                            {{ $inventory->serial_number }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Price:</strong>
                            <label class="badge badge-success">{{ $inventory->price }}</label>
                        </div>
                    </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category:</strong>
                            {{ \App\InventoryCategory::where(['parent_id' => $inventory->category_id])->pluck('name')->first() }}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Sub Category:</strong>
                            {{ \App\InventoryCategory::where(['id' => $inventory->subcategory_id])->pluck('name')->first() }}
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Quantity:</strong>
                            {{ $inventory->quantity }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Start Time:</strong>
                            {{ $inventory->start_time }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>End Time:</strong>
                            {{ $inventory->end_time }}
                        </div>
                    </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $inventory->description }}
                        </div>
                    </div>
                  
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>Image:</strong>
                        <div class="form-group"> 
                              
                            <div class="col-md-3 col-sm-3 col-xs-3">
                              <img src="{{ $inventory->item_image }}" style="max-width:150px !important;">
                            </div>
                        </div>
                    </div>
                </div>
                
        </table>                              
    </div>
</div>     
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

@endsection

//inventory edit

@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="pull-left">
                        <h2>Edit Inventory</h2>
                    </div>
                    <div class="pull-right">
                        @can('inventory-create')
                            <a class="btn btn-success" style="color: white !important;" href="{{ route('inventory.index') }}"> Back</a>
                        @endcan
                    </div>
                    <div class="clearfix"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                  </div>
                  <div class="x_content">
                    <br>
                  {{ csrf_field() }}    
                  
                      <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
                      
                        {!! Form::model($inventory, ['method' => 'PATCH', 'enctype' => 'multipart/form-data' ,'route' => ['inventory.update', $inventory->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    {!! Form::text('item_name', null, array('placeholder' => 'Item Name','class' => 'form-control', 'required')) !!}
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Category:</strong>
                                    <select class="form-control" name="category" id="category">
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}" {{$inventory->category_id == $category['id']  ? 'selected' : ''}}>{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>SubCategory:</strong>
                                    <select class="form-control" name="subcategory" id="subcategory">
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory['id'] }}" {{$inventory->subcategory_id == $subcategory['id']  ? 'selected' : ''}}>{{ $subcategory['name'] }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Quantity:</strong>
                                    {!! Form::number('quantity', null , array('placeholder' => 'Quantity' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control', 'required')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Serial Number:</strong>
                                    {!! Form::text('serial_number', null , array('placeholder' => 'Serial Number' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Start Time:</strong>
                                    <div class="input-group clockpicker">
                                        {!! Form::text('start_time', '18:00' , array('placeholder' => 'Start Time' ,'class' => 'form-control')) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>End Time:</strong>
                                    <div class="input-group clockpicker">
                                        {!! Form::text('end_time', '18:30' , array('placeholder' => 'End Time' ,'class' => 'form-control')) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    {!! Form::textarea('description', null , array('placeholder' => 'Description' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Attachments:</strong>
                                <div class="form-group" style= "margin-top: 5px;"> 
                                        {!! Form::file('image') !!}
                                        @if($inventory['item_image'])   
                                                <div class="col-md-6 col-sm-6 col-xs-6" style= "margin-top: 5px;">
                                                  <img src="{{ $inventory['item_image'] }}" style="max-width:100px; max-height:100px">
                                                </div>
                                        @else
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                      No Image Found.
                                                </div>
                                        @endif
                                    </div>
                             </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style= "margin-top: 5px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        
                      </table>
                  </div>
                </div>
              </div>
</div>


<style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
</style>
<script type="text/javascript">
    $('#category').change(function(){
    var categoryID = $(this).val();    
    if(categoryID){
        $.ajax({
           type:"GET",
           url:"{{url('subcategorylist')}}/"+categoryID,
           success:function(res){               
            if(res){
                $("#subcategory").empty();
                $("#subcategory").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#subcategory").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#subcategory").empty();
            }
           }
        });
    }else{
        $("#subcategory").empty();
    }      
   });
    
</script>
@endsection

//notification index

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Notification List</h2>
    <div class="pull-right">
      @can('user-create')
        <a class="btn btn-success" style="color: white !important" href="{{ route('notifications.create') }}"> Add New Notification</a>
            @endcan
        </div>
        <div class="clearfix"></div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
      </div>
      <div class="x_content">      <!--  table-striped table-bordered -->
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table " style="font-size:12px;width:100% !important">
              <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Department Name</th>
                       <th>Department Head</th>
                      <th>Type</th>                       
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>

                    @foreach ($datas as $key => $user)
            <tr>
            <td>{{ ++$i }}</td>
            <td>{{\App\Department::where(['id' => $user->department_id])->pluck('department')->first()}}</td>

            <td>{{\App\User::where(['id' => $user->user_id])->pluck('name')->first()}}</td>     
            <td>                  
              <label class="badge badge-success"> {{\App\Role::where(['id'=> $user->role_id])->pluck('name')->first()}}</label>              
            </td> 
               
            
            <td>
               <a class="btn btn-info" style="color: white !important" href="{{ route('notifications.show',$user->id) }}">Show</a>
              
             <!-- @can('user-edit')
               <a class="btn btn-primary" style="color: white !important" href="{{ route('users.edit',$user->id) }}">Edit</a>
               @endcan -->
              @can('user-delete')
              {!! Form::open(['method' => 'DELETE','route' => ['notifications.destroy', $user->id],'onClick'=>"return confirm('Are you sure you want to delete?')", 'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
              @endcan
            </td>
            </tr>
           @endforeach      
              </tbody>
              <tfoot>
                    <tr>           
                      <th>S.No</th>
                      <th>Department Name</th>
                       <th>Department Head</th>
                      <th>Type</th>                       
                      <th>Action</th>
                  </tr>
              </tfoot>
          </table>                              
        </div>
</div>
  {!! $datas->render() !!}        
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

@endsection

//show notification

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <div class="pull-left">
            <h2>Show Details</h2>
        </div>
        <div class="pull-right">
            @can('role-create')
                <a class="btn btn-success" style="color: white !important;" href="{{ route('notifications.index') }}"> Back</a>
            @endcan
        </div>
        <div class="clearfix"></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
      </div>
      <div class="x_content">     
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
          
              <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            @foreach($users as $user)
                            <strong>Name:</strong>
                            {{\App\User::where(['id' => $user->user_id])->pluck('name')->first()}}
                        </div>
                    </div>
                    

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Department Name:</strong>
                            {{\App\Department::where(['id' => $user->department_id])->pluck('department')->first()}}
                        </div>
                    </div>

                    

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email-ID:</strong>
                            {{\App\User::where(['id' => $user->user_id])->pluck('email')->first()}}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{\App\User::where(['id' => $user->user_id])->pluck('phone')->first()}}
                        </div>
                    </div>

                    

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Company Name:</strong>
                            {{\App\User::where(['id' => $user->user_id])->pluck('company_name')->first()}}
                        </div>
                    </div>
                    @endforeach
                </div>
                
          </table>                              
        </div>
</div>     
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

@endsection


//notification create

@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="pull-left">
                        <h2>Create New Notifications</h2>
                    </div>
                    <div class="pull-right">
                        @can('user-create')
                            <a class="btn btn-success" style="color:white !important" href="{{ route('notifications.index') }}"> Back</a>
                        @endcan
                    </div>
                    <div class="clearfix"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                  </div>
                  <div class="x_content">
                    <br>
                  {{ csrf_field() }}    
                  
                      <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
                      
                        {!! Form::open(array('route' => 'notifications.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                        <div class="row">                       
                        

                            <div class="col-md-6 col-sm-6 col-xs-6" >
                                <div class = "form-group">
                                    <strong>Role Name:</strong>
                                    <select class="form-control" name="role"  multiple>

                                        @foreach($roles as $role)
                                            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class = "form-group">
                            <strong>Department:</strong>
                            <select class="form-control" name="department" multiple>
                             @foreach($departments as $department)
                              <option value= "{{ $department['id'] }}">{{ $department['department'] }}</option>
                                        @endforeach
                              </select>
                            </div>
                        </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-success" style="margin-top: 100px;">Create Notification</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        
                      </table>
                  </div>
                </div>
              </div>
</div>


<style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>
@endsection

//Approved index


@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Approved Expense List</h2>
    <div class="pull-right">
      <label><input type="search" name="search" id="search" class="form-control input-sm" placeholder="Search by title" aria-controls="eventsData"></label>
      
    <a class="btn btn-warning" style="color: white !important;" href="{{ route('home') }}"> Back</a>
                    
        </div>
        <div class="clearfix"></div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
      </div>
      <div class="x_content">     <!--  table-striped table-bordered --> 
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table" style="font-size:12px;width:100% !important">
              <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>UserName</th>
                      <th>Category</th>
                      <th>Currency</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>

                    @foreach ($datas as $expense)
                    
            <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $expense->title }}</td>
            <td>{{ $expense->price }}</td>
            <td>
                            @if($expense->name)
                  <label class="badge badge-success">{{ $expense->name }}</label>
                            @else
                              <label class="badge badge-success">{{ $expense->user->name }}</label>   
                            @endif
                        </td>
            <td>{{ $expense->category_name }}</td>
            <td>{{ $expense->currency_name }}</td>
            <td>
               <a class="btn btn-info" style="color: white !important" href="{{ url('approveexpense/'.$expense->expenseId.'/ApprovedExpenseshow')}}">Show</a>
             
           
            </td>
            </tr>
           @endforeach      
              </tbody>
              <tfoot>
                    <tr> 
            <th>S.No</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>UserName</th>
                      <th>Category</th>
                      <th>Currency</th>
                      <th>Action</th>
                  </tr>
              </tfoot>
          </table>                              
        </div>
</div>




{!! $datas->render() !!}        
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

       <script type="text/javascript">
       
        $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
        type : 'get',
        url : '{{URL::to('searchApproved')}}',
        data:{'search':$value},
        success:function(data){
        $('tbody').html(data);
        }
        });
            
          });   
            
      </script>
   
   </script>
        <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
   
@endsection

//expense create

@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="pull-left">
                        <h2>Create New Expense</h2>
                    </div>
                    <div class="pull-right">
                       
                            <a class="btn btn-success" style="color: white !important;" href="{{ route('expenses.index') }}"> Back</a>
                       
                    </div>
                    <div class="clearfix"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                  </div>
                  <div class="x_content">
                    <br>
                  {{ csrf_field() }}    
                  
                      <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
                      
                        {!! Form::open(array('route' => 'expenses.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    {!! Form::number('price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Category:</strong>
                                    <select class="form-control" name="category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Currency:</strong>
                                    <select class="form-control" name="currency">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency['id'] }}">{{ $currency['currency_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Project Name:</strong>
                                    <select class="form-control" name="project">
                                        @foreach($projects as $project)
                                            <option value="{{ $project['id'] }}">{{ $project['ProjectName'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Department Name:</strong>
                                    <select class="form-control" name="department">
                                        @foreach($departments as $department)
                                            <option value="{{ $department['id'] }}">{{ $department['department'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Date:</strong>
                                    {!! Form::date('date', null , array('placeholder' => 'Date' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Time:</strong>
                                    <div class="input-group clockpicker">
                                        {!! Form::text('time', '18:00' , array('placeholder' => 'Time' ,'class' => 'form-control')) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>        
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Attachments :</strong>
                                    {!! Form::file('image[]', array('multiple')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit Expense</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        
                      </table>
                  </div>
                </div>
              </div>
</div>


<style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
</style>
<script type="text/javascript">
        $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            donetext: 'Done'
        });
    </script>
@endsection

//reject expense index


@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Rejected Expense List</h2>
    <div class="pull-right">
      <label><input type="text" name="search" id="search" class="form-control input-sm" placeholder="Search by title" aria-controls="eventsData"></label>
      
    <a class="btn btn-warning" style="color: white !important;" href="{{ route('home') }}"> Back</a>
                    
        </div>
        <div class="clearfix"></div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
    @endif
      </div>
      <div class="x_content">      <!--  table-striped table-bordered -->
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table" style="font-size:12px;width:100% !important">
              <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>UserName</th>
                      <th>Category</th>
                      <th>Currency</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>

                    @foreach ($datas as $expense)
                    
            <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $expense->title }}</td>
            <td>{{ $expense->price }}</td>
            <td>
                            @if($expense->name)
                  <label class="badge badge-success">{{ $expense->name }}</label>
                            @else
                              <label class="badge badge-success">{{ $expense->user->name }}</label>   
                            @endif
                        </td>
            <td>{{ $expense->category_name }}</td>
                        <td>{{ $expense->currency_name }}</td>
            <td>
               <a class="btn btn-info" style="color: white !important" href="{{ url('rejectexpenses/'.$expense->expenseId.'/RejectExpenseshow')}}">Show</a>
              
            
            </td>
            </tr>
           @endforeach      
              </tbody>
              <tfoot>
                    <tr> 
            <th>S.No</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>UserName</th>
                      <th>Category</th>
                      <th>Currency</th>
                      <th>Action</th>
                  </tr>
              </tfoot>
          </table>                              
        </div>
</div>
{!! $datas->render() !!}        
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

      <script type="text/javascript">
       
        $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
        type : 'get',
        url : '{{URL::to('search')}}',
        data:{'search':$value},
        success:function(data){
        $('tbody').html(data);
        }
        });
            
          });   
            
      </script>
   
   </script>
        <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>
@endsection

//expense reject show

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <div class="pull-left">
            <h2>Show Rejected Expense</h2>
        </div>
        <div class="pull-right">
            
                <!-- <a class="btn btn-success" style="color: white !important" href="{{ route('expensereject.index') }}"> Back</a> -->
           
        </div>
        <div class="clearfix"></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
      </div>
      <div class="x_content">     
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
          
              <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $expense->title }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $expense->price }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User:</strong>
                            <label class="badge badge-success">{{ $expense->user->name }}</label>
                        </div>
                    </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category:</strong>
                            {{ $expense->category_name }}
                        </div>
                    </div>
                    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Currency:</strong>
                            {{ $expense->currency_name }}
                        </div>
                    </div> -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Date:</strong>
                            {{ $expense->date }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Time:</strong>
                            {{ $expense->time }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>Attachments:</strong>
                        <div class="form-group"> 
                                
                                @foreach($attachments as $files) 
                                     @if($files['attach_link'])   
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                          <img src="{{ $files['attach_link'] }}" style="max-width:100px; max-height:100px">
                                        </div>
                                    @else
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                              No Image Found.
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                      </div>
                </div>
                
          </table>                              
    </div>
</div>     
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

@endsection


//approved expense show

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <div class="pull-left">
            <h2>Show Approved Expense</h2>
        </div>
        
        <div class="clearfix"></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
      </div>
      <div class="x_content">     
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
          
              <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $expense->title }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $expense->price }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User:</strong>
                            <label class="badge badge-success">{{ $expense->user->name }}</label>
                        </div>
                    </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category:</strong>
                            {{ $expense->category_name }}
                        </div>
                    </div>
                    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Currency:</strong>
                            {{ $expense->currency_name }}
                        </div>
                    </div> -->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Date:</strong>
                            {{ $expense->date }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Time:</strong>
                            {{ $expense->time }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>Attachments:</strong>
                        <div class="form-group"> 
                                
                                @foreach($attachments as $files) 
                                     @if($files['attach_link'])   
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                          <img src="{{ $files['attach_link'] }}" style="max-width:100px; max-height:100px">
                                        </div>
                                    @else
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                              No Image Found.
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                      </div>
                </div>
                
          </table>                              
    </div>
</div>     
      <style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>

@endsection

//category edit

@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$category->category_name}}</h2>
                    <div class="pull-right">
                        @can('category-create')
                            <a class="btn btn-success" href="{{ route('category.index') }}"> Back</a>
                        @endcan
                    </div>
                    <div class="clearfix"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                  </div>
                  <div class="x_content">
                    <br>
                  {{ csrf_field() }}    
                  
                      <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
                      
                        {!! Form::model($category, ['method' => 'PATCH' ,'route' => ['category.update', $category->id]]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('category_name', null, array('placeholder' => 'Category Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        
                      </table>
                  </div>
                </div>
              </div>
</div>


<style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
      </style>
@endsection

//inventory create


@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="pull-left">
                        <h2>Create New Inventory</h2>
                    </div>
                    <div class="pull-right">
                        
                            <a class="btn btn-success" style="color: white !important;" href="{{ route('inventory.index') }}"> Back</a>
                    
                    </div>
                    <div class="clearfix"></div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                  </div>
                  <div class="x_content">
                    <br>
                  {{ csrf_field() }}    
                  
                      <table id="usersData" class="table-responsive table table-striped table-bordered" style="font-size:12px;width:100% !important">
                      
                        {!! Form::open(array('route' => 'inventory.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Item Name:</strong>
                                    {!! Form::text('item_name', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Category:</strong>
                                    <select class="form-control" name="category" id="category">
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>SubCategory:</strong>
                                    <select class="form-control" name="subcategory" id="subcategory">
                                        <option value=""> </option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Quantity:</strong>
                                    {!! Form::number('quantity', null , array('placeholder' => 'Quantity' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Price:</strong>
                                    {!! Form::number('price', null , array('placeholder' => 'Price' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Serial Number:</strong>
                                    {!! Form::text('serial_number', null , array('placeholder' => 'Serial Number' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Start Time:</strong>
                                    <div class="input-group clockpicker">
                                        {!! Form::text('start_time', '18:00' , array('placeholder' => 'Start Time' ,'class' => 'form-control')) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>End Time:</strong>
                                    <div class="input-group clockpicker">
                                        {!! Form::text('end_time', '18:30' , array('placeholder' => 'End Time' ,'class' => 'form-control')) !!}
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    {!! Form::textarea('description', null , array('placeholder' => 'Description' ,'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Attachments :</strong>
                                    {!! Form::file('image[]', array('multiple')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        
                      </table>
                  </div>
                </div>
              </div>
</div>


<style>
        .dataTables_paginate a {
          background-color:#fff !important;
        }
        .dataTables_paginate .pagination>.active>a{
          color: #fff !important;
          background-color: #337ab7 !important;
        }
</style>
<script type="text/javascript">
    $('#category').change(function(){
    var categoryID = $(this).val();    
    if(categoryID){
        $.ajax({
           type:"GET",
           //alert('gnj') ;return false;
           url:"{{url('subcategorylist')}}/"+categoryID,
           success:function(res){               
            if(res){
                $("#subcategory").empty();
                $("#subcategory").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#subcategory").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#subcategory").empty();
            }
           }
        });
    }else{
        $("#subcategory").empty();
    }      
   });
    
</script>
@endsection




