<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}



      

        <!-- FastClick -->
    <script src="{{ url('/') }}/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
    <script src="{{ url('/') }}/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="{{ url('/') }}/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{ url('/') }}/vendors/gauge.js/dist/gauge.min.js"></script>
     <!-- bootstrap-progressbar -->
    
    <!-- iCheck -->
    <script src="{{ url('/') }}/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="{{ url('/') }}/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="{{ url('/') }}/vendors/Flot/jquery.flot.js"></script>
    <script src="{{ url('/') }}/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="{{ url('/') }}/vendors/Flot/jquery.flot.time.js"></script>
    <script src="{{ url('/') }}/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="{{ url('/') }}/vendors/Flot/jquery.flot.resize.js"></script>

    <!-- Flot plugins -->
    <script src="{{ url('/') }}/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="{{ url('/') }}/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="{{ url('/') }}/vendors/flot.curvedlines/curvedLines.js"></script>

    <!-- DateJS -->
    <script src="{{ url('/') }}/vendors/DateJS/build/date.js"></script>

    <!-- JQVMap -->
    <script src="{{ url('/') }}/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="{{ url('/') }}/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="{{ url('/') }}/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ url('/') }}/vendors/moment/min/moment.min.js"></script>
    <script src="{{ url('/') }}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    

    <script src="{{url('/')}}/js/ckeditor/ckeditor.js"></script>

    //include on head section
    