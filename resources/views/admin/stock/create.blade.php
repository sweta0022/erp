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
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Item Name</th>
                        <th scope="col">Batch Number</th>
                        <th scope="col">MRP</th>
                        <th scope="col">Stock In</th>
                        <th scope="col">Total Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $itemMaster as $val )
                        <tr>
                            <td>{{$val->name}}</td>
                            <td><input type="text" name="batch_num[]" placeholder="Batch No." /></td>
                            <td> 
                                <select name="mrp[]"> 
                                    @if($val->item_price->count() > 1)
                                    <option value="">Please Select</option>
                                    @endif
                                    @foreach( $val->item_price as $price )
                                    <option value="">{{$price->mrp}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="Number" name="stock[]" placeholder="Stock No." /></td>
                            <td>
                                {{$val->totalStock($val->id)}}
                                @if($val->item_price->count() > 1)
                                <button class="btn-primary" onclick="return openStockDetailMOdal()" >Stock Detail</button> 
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </form>

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    <!-- modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Stock Detail</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>
    <!-- end modal -->
@endsection
@section("post_script")
<script type="text/javascript">
        $(document).ready(function () {
            if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
            }
        });

        function validate()
        { 
            return true;
        }

        function openStockDetailMOdal()
        {
            $('#myModal').modal('show'); return false;
        }
    </script>
@endsection