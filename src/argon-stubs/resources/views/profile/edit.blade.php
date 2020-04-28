

@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('assets/img/theme/team-4-800x800.jpg')}}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Connect') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">{{ __('Friends') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">{{ __('Photos') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">{{ __('Comments') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ auth()->user()->name }}<span class="font-weight-light">, 27</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ __('Bucharest, Romania') }}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ __('Solution Manager - Creative Tim Officer') }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ __('University of Computer Science') }}
                            </div>
                            <hr class="my-4" />
                            <p>{{ __('Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.') }}</p>
                            <a href="#">{{ __('Show more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
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


//user update
<!-- 
@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$users->name}}<small>{{$users->email}}</small></h2>
                    <div class="pull-right">
                        @can('user-create')
                            <a class="btn btn-success" style="color: white!important"href="{{ route('users.index') }}"> Back</a>
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
                      
                        {!! Form::model($users, ['method' => 'PATCH', 'enctype' => 'multipart/form-data' ,'route' => ['users.update', $users->id]]) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        {!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Company Name:</strong>
                                        {!! Form::text('company_name', null, array('placeholder' => 'Company Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class = "form-group">
                                        <strong>Department:</strong>
                                        <select class="form-control" name="department"  required>
                                            @foreach($getDepartment as $department)
                                                <option value="{{ $department['id'] }}" {{$users->department_id == $department['id']  ? 'selected' : ''}}>{{ $department['department'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class = "form-group">
                                    <strong>Project Name:</strong>
                                    <select class="form-control" name="project"  required>

                                        @foreach($getprojectName as $projectName)
                                            <option value="{{ $projectName['id'] }}" {{$users->project_id == $projectName['id']  ? 'selected' : ''}}>{{ $projectName['ProjectName'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class = "form-group">
                                        <strong>Currency:</strong>
                                        <select class="form-control" name="currency"  required>
                                            @foreach($getCurrency as $currency)
                                                <option value="{{ $currency['id'] }}" {{$users->currency_id == $currency['id']  ? 'selected' : ''}}>{{ $currency['currency_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Phone:</strong>
                                        {!! Form::text('phone', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Role:</strong>
                                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Profile:</strong>
                                        {!! Form::file('image') !!}
                                        <img src="{{ $users->image_url }}" style="max-width:200px; max-height:200px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status:</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <select class="form-control" name="is_blocked">
                                        <option value="0">--Status--</option>
                                        <option value="1" @if ($users->is_blocked==1) selected @endif>Active</option>
                                        <option value="0" @if ($users->is_blocked==0) selected  @endif>De-active</option>
                                      </select>
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
@endsection -->
//show user

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <div class="pull-left">
            <h2>Show User</h2>
        </div>
        <div class="pull-right">
            @can('role-create')
                <a class="btn btn-success" style="color: white !important;" href="{{ route('users.index') }}"> Back</a>
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
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Roles:</strong>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
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

//roles index

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Role List</h2>
    <div class="pull-right">
      
        <a class="btn btn-success" style="color: white !important" href="{{ route('roles.create') }}"> Create New Role</a>

         <a class="btn btn-warning" style="color: white !important;" href="{{ route('home') }}"> Back</a>
           
        </div>
        <div class="clearfix"></div>
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
      </div>
      <div class="x_content">     
          {{ csrf_field() }}             
          <table id="usersData" class="table-responsive table  " style="font-size:12px;width:100% !important">
              <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Name</th>                  
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach ($roles as $key => $role)
            <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
               @can('role-list')
               <a class="btn btn-info" style="color: white !important" href="{{ route('roles.show',$role->id) }}">Show</a>
               @endcan
            
               <a class="btn btn-primary" style="color: white !important" href="{{ route('roles.edit',$role->id) }}">Edit</a>
           
             
              {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id], 'onClick'=>"return confirm('Are you sure you want to delete?')", 'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
             
            </td>
            </tr>
           @endforeach      
              </tbody>
              <tfoot>
                    <tr> 
            <th>S.No</th>
                      <th>Name</th>                  
                      <th>Action</th>
                  </tr>
              </tfoot>
          </table>                              
        </div>
</div>

  {!! $roles->render() !!}        
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

//role edit

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Edit Role</h2>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.index') }}"> Back</a>
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
          
              {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                            <br/>
                            @endforeach
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


//role create

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Create Role</h2>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" style="color: white !important"href="{{ route('roles.index') }}"> Back</a>
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
              
              {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                            <br/>
                            @endforeach
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

//category index

@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        <h2>Category List</h2>
        <div class="pull-right">
        
                <a class="btn btn-success" style="color: white !important" href="{{ route('category.create') }}"> Create New Category</a>
        
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
                      <th>Category Name</th>                   
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                    @foreach ($data as $key => $category)
                      <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                           <!-- <a class="btn btn-info" style="color: white !important" href="{{ route('category.show',$category->id) }}">Show</a>
                             -->
                            
                           <a class="btn btn-primary" style="color: white !important" href="{{ route('category.edit',$category->id) }}">Edit</a>
                        
                            {!! Form::open(['method' => 'DELETE','route' => ['category.destroy', $category->id], 'onClick'=>"return confirm('Are you sure you want to delete?')", 'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        
                        </td>
                      </tr>
                     @endforeach      
              </tbody>
              <tfoot>
                    <tr> 
                      <th>S.No</th>
                      <th>Category Name</th>                   
                      <th>Action</th>
                  </tr>
              </tfoot>
          </table>                              
        </div>
</div>
  {!! $data->render() !!}        
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

//category create

@extends('layout.app')

@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="pull-left">
                        <h2>Create New Category</h2>
                    </div>
                    <div class="pull-right">
                        @can('category-create')
                            <a class="btn btn-success" style="color: white !important;" href="{{ route('category.index') }}"> Back</a>
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
                      
                        {!! Form::open(array('route' => 'category.store','method'=>'POST')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Category Name:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Category Name','class' => 'form-control')) !!}
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



