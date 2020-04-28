@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Users') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if ($user->id != auth()->id())
                                                        <form action="{{ route('user.destroy', $user) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('user.edit', $user) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    
                                                    @else
                                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection

<!-- 
@extends('layout.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="right_col" role="main">
  @include('layout/flash')
  <div class="x_panel">
      <div class="x_title">
        
        <h2 class="text">User List</h2>
       
    <div class="pull-right">
      @can('user-create')
        <a class="btn btn-success" style="color: white !important" href="{{ route('users.create') }}"> Create New User</a>

         <a class="btn btn-warning" style="color: white !important;" href="{{ route('home') }}"> Back</a>
            @endcan
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
          <table id="usersData" class="table-responsive table " style="font-size:12px;width:100% !important">
              <thead>
                  <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Type</th>
                                        
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>

                    @foreach ($data as $key => $user)
            <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->phone }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
                 <label class="badge badge-success">{{ $v }}</label>
              @endforeach
              @endif
            </td>          
            
            <td>
               <a class="btn btn-outline-primary" style="border: 1px solid #00c0ef; color:#00c0ef !important; " href="{{ route('users.show',$user->id) }}">Show</a>
              
             @can('user-edit')
               <a class="btn btn-outline-primary" style="border: 1px solid #00bf86; color:#00bf86 !important; " href="{{ route('users.edit',$user->id) }}">Edit</a>
               @endcan
              @can('user-delete')
              {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id], 'onClick'=>"return confirm('Are you sure you want to delete?')", 'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger','style'=>'border: 1px solid #ff8086','color:#ff8086 !important;']) !!}
              {!! Form::close() !!}
              @endcan
            </td>
            </tr>
           @endforeach      
              </tbody>
              <tfoot>
                    <tr> 
            <th>S.No</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Type</th>
                                    
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
 -->