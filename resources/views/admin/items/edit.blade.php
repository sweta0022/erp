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
                        <a href="{{url('/users')}}">Item</a>
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

                <form  action="{{route('item-update')}}" method="POST" class="form-horizontal" role="form" onsubmit="return validate()">
                @csrf
                <input type="hidden" name="update_id" value="{{$data[0]->id}}" >
                    <!-- New Design  -->
                    <div class="row">
                        <div class="clearfix form-actions">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="item_code"> Item Code </label>
                                    <input type="text" id="item_code" name="item_code" value="{{$data[0]->item_code}}" placeholder="Item Code" class="form-control" />
                                    @if ($errors->has('item_code'))
                                        <span class="text-danger">{{ $errors->first('item_code') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="name"> Name </label>
                                    <input type="text" id="name" name="name" value="{{$data[0]->name}}" placeholder="Name" class="form-control" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="control-label" for="unit_measurement"> Unit Measurement </label>
                                <select class="form-control" name="unit_measurement" id="unit_measurement">
                                    <option value="">Please Select</option>
                                    @foreach( $unitMeasurement as $unitMeasurementV )
                                    <option value="{{$unitMeasurementV->id}}" {{($data[0]->measurement_id == $unitMeasurementV->id)?'selected':''}} >{{$unitMeasurementV->name}} ({{$unitMeasurementV->code}})</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('unit_measurement'))
                                    <span class="text-danger">{{ $errors->first('unit_measurement') }}</span>
                                @endif
                            </div>
                            
                           
                            
                        </div>
                    </div>    
                    
                    <div class="row">
                        <div class="clearfix form-actions">
                        <!-- <div class="form-group"> -->
                        <div class="col-md-4">
                                <label class="control-label" for="category"> Category </label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Please Select</option>
                                    @foreach( $category as $categoryV )
                                    <option value="{{$categoryV->id}}" {{($data[0]->category_id == $categoryV->id)?'selected':''}} >{{$categoryV->name}} ({{$categoryV->code}})</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                        </div>

                                <div class="col-md-4">
                                <label class="control-label" for="item_class"> Item Class </label>
                                <select class="form-control" name="item_class" id="item_class">
                                    <option value="">Please Select</option>
                                    @foreach( $itemclass as $itemclassV )
                                    <option value="{{$itemclassV->id}}" {{($data[0]->item_class_id == $itemclassV->id)?'selected':''}} >{{$itemclassV->name}} ({{$itemclassV->code}})</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('item_class'))
                                            <span class="text-danger">{{ $errors->first('item_class') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                     <label class="control-label" for="pcs_in_box"> Pcs in box </label>
                                    <input type="number" id="pcs_in_box" value="{{$data[0]->pcs_in_box}}" name="pcs_in_box" placeholder="Quantity" class="form-control" />
                                    @if ($errors->has('pcs_in_box'))
                                        <span class="text-danger">{{ $errors->first('pcs_in_box') }}</span>
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