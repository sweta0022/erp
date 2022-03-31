@extends('admin.layouts.master')
@section("content")
    <div class="main-content">
        <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{{url('/dashboard')}}">Dashboard</a>
                    </li>

                    <li>
                        <a href="{{url('/users')}}">Users</a>
                    </li>
                    <li class="active"> Create </li>
                </ul><!-- /.breadcrumb -->

        </div>

            <div class="page-content">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="ace-icon fa fa-cog bigger-130"></i>
                    </div>

                    <div class="ace-settings-box clearfix" id="ace-settings-box">
                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>&nbsp; Choose Skin</span>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                                <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                                <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                                <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
                                <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                <label class="lbl" for="ace-settings-add-container">
                                    Inside
                                    <b>.container</b>
                                </label>
                            </div>
                        </div><!-- /.pull-left -->

                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                                <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                            </div>
                        </div><!-- /.pull-left -->
                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <form  action="{{route('user-store')}}" method="POST" class="form-horizontal" role="form" onsubmit="return validate()">
                @csrf
                    <!-- New Design  -->
                    <div class="row">
                        <div class="clearfix form-actions">
                            <div class="col-md-3">
                            <div class="form-group">
                                    <label class="control-label" for="name"> Name </label>
                                    <input type="text" id="name" name="name" placeholder="Username" class="form-control" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                            <label class="control-label" for="name"> Email </label>
                            <input type="text" id="email" name="email" placeholder="E-mail" class="form-control" />
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            </div>
                            <div class="col-md-3">
                            <label class="control-label" for="name"> Password </label>
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control" />
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            </div>
                            <div class="col-md-3">
                            <label class="control-label" for="name"> Confirm Password </label>
                            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control" />
                            @if ($errors->has('cpassword'))
                                <span class="text-danger">{{ $errors->first('cpassword') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>    
                    
                    <div class="row">
                        <div class="clearfix form-actions">
                        <!-- <div class="form-group"> -->
                            <div class="col-md-4">
                                <label class="control-label" for="name"> Phone no. </label>
                                    <input type="text" id="phone" name="phone" placeholder="Phone no." class="form-control" />
                                    @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                <label class="control-label" for="name"> Role </label>
                                <select class="form-control" name="role" id="role">
                                    <option value="">Please Select</option>
                                    @foreach( $allRole as $allRoleV )
                                    <option value="{{$allRoleV->id}}">{{$allRoleV->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                            <span class="text-danger">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label class="control-label" for="senior"> Senior </label>
                                <!-- <select class="form-control chosen-select" data-placeholder="Choose a senior..." name="senior" multiple="" id="senior"> -->
                                <select class="form-control" data-placeholder="Choose a senior..." name="senior" multiple="" id="senior"></select>
                                @if ($errors->has('senior'))
                                    <span class="text-danger">{{ $errors->first('senior') }}</span>
                                @endif
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="clearfix form-actions">
                            <div class="col-md-4">
                            <label class="control-label" for="name"> State </label>
                            <select class="form-control" name="state" id="state">
                                                <option value="">Please Select</option>
                                                @foreach( $allState as $allStateV )
                                                <option value="{{$allStateV->id}}">{{$allStateV->name}}</option>
                                                @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <label class="control-label" for="name"> City </label>
                            <select class="form-control" name="city" id="city"></select>
                            @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                            </div>
                            <div class="col-md-4">
                            <label class="control-label" for="name"> Zone </label>
                            <select class="form-control" name="zone" id="zone"></select>
                            @if ($errors->has('zone'))
                                    <span class="text-danger">{{ $errors->first('zone') }}</span>
                            @endif
                            </div>
                        </div>
                    </div> 

                    <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                    </div>


                    <!-- End New Design -->

                </form>


                {{-- <div class="row">

                   
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="name"> Name </label>

                                <div class="col-sm-9">
                                    <input type="text" id="name" name="name" placeholder="Username" class="col-xs-10 col-sm-5" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="email"> Email </label>

                                <div class="col-sm-9">
                                    <input type="email" id="email" name="email" placeholder="E-mail" class="col-xs-10 col-sm-5" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="password"> Password </label>

                                <div class="col-sm-9">
                                    <input type="password" id="password" name="password" placeholder="Password" class="col-xs-10 col-sm-5" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="cpassword"> Confirm Password </label>

                                <div class="col-sm-9">
                                    <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" class="col-xs-10 col-sm-5" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="phone"> Phone No. </label>

                                <div class="col-sm-9">
                                    <input type="text" id="phone" name="phone" placeholder="Phone no." class="col-xs-10 col-sm-5" />
                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="role"> Role </label>

                                <div class="col-sm-9">
                                    <select class="col-xs-10 col-sm-5" name="role" id="role">
                                            <option value="">Please Select</option>
                                            @foreach( $allRole as $allRoleV )
                                            <option value="{{$allRoleV->id}}">{{$allRoleV->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="state"> State </label>

                                <div class="col-sm-9">
                                    <select class="col-xs-10 col-sm-5" name="state" id="state">
                                            <option value="">Please Select</option>
                                            @foreach( $allState as $allStateV )
                                            <option value="{{$allStateV->id}}">{{$allStateV->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="city"> City </label>

                                <div class="col-sm-9">
                                    <select class="col-xs-10 col-sm-5" name="city" id="city"></select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="zone"> Zone </label>

                                <div class="col-sm-9">
                                    <select class="col-xs-10 col-sm-5" name="zone" id="zone"></select>
                                </div>
                            </div>


                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="button">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>


                        </form>

                    </div><!-- /.col -->
                </div> --}}


            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection
@section("post_script")
<script type="text/javascript">
        $(document).ready(function () {
            if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
            }

            $('#role').on('change', function () {
                var roleId = this.value;
                $('#senior').html('');
                $.ajax({
                    url: '{{ route('getSeniors') }}?role_id='+roleId,
                    type: 'get',
                    success: function (res) {
                        if( res )
                        {
                            $.each(res, function (key, value) {
                            $('#senior').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });   
                        }
                              

                        // $('.chosen-results').html('<option value="">Select Senior</option>');
                        // $.each(res, function (key, value) {
                        //     $('.chosen-results').append('<li class="active-result" data-option-array-index="'+value
                        //         .id+'" style="">'+value.name+'</li>');
                        // });
                    }
                });
            });

            $('#state').on('change', function () {
                var stateId = this.value;
                $('#city').html('');
                $.ajax({
                    url: '{{ route('getCities') }}?stateId='+stateId,
                    type: 'get',
                    success: function (res) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(res, function (key, value) {
                            $('#city').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#zone').html('<option value="">Select Zone</option>');
                    }
                });
            });
            $('#city').on('change', function () {
                var cityId = this.value;
                $('#zone').html('');
                $.ajax({
                    url: '{{ route('getZones') }}?city_id='+cityId,
                    type: 'get',
                    success: function (res) {
                        $('#zone').html('<option value="">Select Zone</option>');
                        $.each(res, function (key, value) {
                            $('#zone').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });

           
        });

        function validate()
            { 
                return true;
            }
    </script>
@endsection