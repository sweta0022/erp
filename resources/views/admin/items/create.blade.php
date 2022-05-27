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
               
                <form  action="{{route('item-store')}}" method="POST" class="form-horizontal" role="form" onsubmit="return validate()">
                     @csrf
                    <!-- New Design  -->
                    <div class="row">
                        <div class="">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="item_code"> Item Code </label>
                                    <input type="text" id="item_code" name="item_code" placeholder="Item Code" class="form-control" />
                                    @if ($errors->has('item_code'))
                                        <span class="text-danger">{{ $errors->first('item_code') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="name"> Name </label>
                                    <input type="text" id="name" name="name" placeholder="Name" class="form-control" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="control-label" for="hsn_code"> HSN Code </label>
                                <input type="text" id="hsn_code" name="hsn_code" placeholder="HSN Code" class="form-control" />
                                
                            </div>

                            <div class="col-md-3">
                                <label class="control-label" for="unit_measurement"> Unit Measurement </label>
                                <select class="form-control" name="unit_measurement" id="unit_measurement">
                                    <option value="">Please Select</option>
                                    @foreach( $unitMeasurement as $unitMeasurementV )
                                    <option value="{{$unitMeasurementV->id}}">{{$unitMeasurementV->name}} ({{$unitMeasurementV->code}})</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('unit_measurement'))
                                    <span class="text-danger">{{ $errors->first('unit_measurement') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>    
                    
                    <div class="row">
                        <div class="">
                            <div class="col-md-3">
                                    <label class="control-label" for="category"> Category </label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="">Please Select</option>
                                        @foreach( $category as $categoryV )
                                        <option value="{{$categoryV->id}}">{{$categoryV->name}} ({{$categoryV->code}})</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                                <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                            </div>

                            <div class="col-md-3">
                                    <label class="control-label" for="item_class"> Item Class </label>
                                    <select class="form-control" name="item_class" id="item_class">
                                        <option value="">Please Select</option>
                                        @foreach( $itemclass as $itemclassV )
                                        <option value="{{$itemclassV->id}}">{{$itemclassV->name}} ({{$itemclassV->code}})</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('item_class'))
                                                <span class="text-danger">{{ $errors->first('item_class') }}</span>
                                    @endif
                            </div>
                            <div class="col-md-3">
                                        <label class="control-label" for="gst"> GST In Percentage </label>
                                        <select class="form-control" name="gst" id="gst">
                                        @foreach( $gst as $gstV )
                                        <option value="{{$gstV->id}}">{{$gstV->value}}</option>
                                        @endforeach
                                    </select>
                                    
                            </div>
                            <div class="col-md-3">
                                        <label class="control-label" for="pcs_in_box"> Pcs in box </label>
                                    <input type="number" id="pcs_in_box" name="pcs_in_box" placeholder="Quantity" class="form-control" />
                                    @if ($errors->has('pcs_in_box'))
                                        <span class="text-danger">{{ $errors->first('pcs_in_box') }}</span>
                                    @endif
                            </div>

                        </div>
                    </div> 

                    <div class="row">
                        <div class="">
                        <!-- <div class="form-group"> -->
                        <div class="col-md-3">
                            <label class="control-label" for="mrp"> Mrp </label>
                            <input type="number" id="mrp" name="mrp" placeholder="MRP" class="form-control" />
                            @if ($errors->has('mrp'))
                                <span class="text-danger">{{ $errors->first('mrp') }}</span>
                            @endif
                        </div>

                        <div class="col-md-3">
                            <label class="control-label" for="cost_price"> Cost Price </label>
                            <input type="number" id="cost_price" name="cost_price" placeholder="Cost Price" class="form-control" />
                            @if ($errors->has('cost_price'))
                                <span class="text-danger">{{ $errors->first('cost_price') }}</span>
                            @endif
                        </div>

                            <div class="col-md-3">
                                     <label class="control-label" for="ss_price"> Super Stockiest Price </label>
                                    <input type="number" id="ss_price" name="ss_price" placeholder="Super Stockiest Price" class="form-control" />
                                    @if ($errors->has('ss_price'))
                                        <span class="text-danger">{{ $errors->first('ss_price') }}</span>
                                    @endif
                            </div>
                            <div class="col-md-3">
                                     <label class="control-label" for="distributor_price"> Distributor Price </label>
                                    <input type="number" id="distributor_price" name="distributor_price" placeholder="Distributor Price" class="form-control" />
                                    @if ($errors->has('distributor_price'))
                                        <span class="text-danger">{{ $errors->first('distributor_price') }}</span>
                                    @endif
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="">
                            <div class="col-md-3"> </div>

                            <div class="col-md-3">  </div>

                            <div class="col-md-3">  </div>
                            <div class="col-md-3"> 
                            <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>
                            </div>
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