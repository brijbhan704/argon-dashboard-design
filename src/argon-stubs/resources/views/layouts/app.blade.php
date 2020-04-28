<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>



<!-- @extends('layout.app')

@section('content')
<div class="right_col" role="main">
 
  <div class="row tile_count">
    <div class="col-md-3 col-sm-3 col-xs-9 tile_stats_count">
      <a class="" href="{{ route('users.index') }}">
      <span class="count_top"><i class="fa fa-users"></i> Total Users</span>
      <div class="count blue">{{$countUser}}</div></a>
    
    </div>    
    <div class="col-md-3 col-sm-3 col-xs-9 tile_stats_count">
      <a class="" href="{{ route('expenses.index') }}">
      <span class="count_top"><i class="fa fa-money"></i> Total Expenses</span>
      <div class="count green">{{$countExpenses}}</div></a>
     
    </div>
    <div class="col-md-3 col-sm-3 col-xs-9 tile_stats_count" >
      <a class="" href="{{ route('category.index') }}">
      <span class="count_top"><i class="fa fa-list-alt"></i> Total Category</span>
      <div class="count red">{{$countCategory}}</div></a>
    
    </div>
    <div class="col-md-3 col-sm-3 col-xs-9 tile_stats_count">
      <a class="" href="{{ route('roles.index') }}">
      <span class="count_top"><i class="fa fa-users"></i> Total Roles</span>
      <div class="count green">{{$countRoles}}</div></a>
     
    </div>

    

  </div>
 
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Welcome</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="dashboard-widget-content">
                <div class="col-md-12 hidden-small" style="text-align: center;font-size: 30px; min-height: 400px;">
                  <h2 class="line_30"></h2>
                    Welcome To Admin Panel Of Enterprise Resource Portal                  
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection -->