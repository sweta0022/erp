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
                        <a href="{{url('/item/list')}}">Items</a>
                    </li>
                    <li class="active"> Total Items ({{$stock->count()}}) </li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form action="" method="GET" class="form-search">
                        <span class="input-icon">
                            <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" value="{{\Request::get('search')}}" />                           
                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                            <button type="submit" class="btn-primary">Search</button>
                        </span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">
               

                <div class="page-header">
                <div class="text-right">
                        <a href="{{url('stock/create')}}" class="btn btn-primary" style="margin-right: 45px;" >Add Stock</a>
                </div>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <!-- <th class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </th> -->
                                            {{-- <th class="detail-col">Detail</th> --}}
                                            <th>S.No</th>
                                            <th>Item Name</th>
                                            <th>Batch Number</th>
                                            <th>Item MRP</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($stock as $key => $itemsV)
                                            <tr>
                                                <!-- <td class="center">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" class="ace" />
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td> -->

                                                {{-- <td class="center">
                                                    <div class="action-buttons">
                                                        <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                            <i class="ace-icon fa fa-angle-double-down"></i>
                                                            <span class="sr-only">Details</span>
                                                        </a>
                                                    </div>
                                                </td> --}}
                                                    <td>{{++$key}}</td>
                                                <td>
                                                    <a href="#">{{$itemsV->name}}</a>
                                                </td>
                                                <td>{{$itemsV->batch_number}}</td>
                                                <td>{{$itemsV->mrp}}</td>
                                                <td>{{$itemsV->stock_in_quantity}}</td>
                                                <td>
                                                    <div class="hidden-sm hidden-xs btn-group">
                                               
                                                        <a href="{{url('item/edit')}}/{{$itemsV->id}}" title="Edit"  class="btn btn-xs btn-info">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i></a> 

                                                    </div>

                                                    {{-- <div class="hidden-md hidden-lg">
                                                        <div class="inline pos-rel">
                                                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                            </button>

                                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                <li>
                                                                    <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                        <span class="blue">
                                                                            <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                        <span class="green">
                                                                            <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                        <span class="red">
                                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> --}}
                                                </td>
                                            </tr>
                                            {{-- <tr class="detail-row">
                                                        <td colspan="8">
                                                            <div class="table-detail">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-2">
                                                                        <div class="text-center">
                                                                            <img height="150" class="thumbnail inline no-margin-bottom" alt="Domain Owner's Avatar" src="assets/images/avatars/profile-pic.jpg" />
                                                                            <br />
                                                                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                                                <div class="inline position-relative">
                                                                                    <a class="user-title-label" href="#">
                                                                                        <i class="ace-icon fa fa-circle light-green"></i>
                                                                                        &nbsp;
                                                                                        <span class="white">Alex M. Doe</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-7">
                                                                        <div class="space visible-xs"></div>

                                                                        <div class="profile-user-info profile-user-info-striped">
                                                                            <div class="profile-info-row">
                                                                                <div class="profile-info-name"> Username </div>

                                                                                <div class="profile-info-value">
                                                                                    <span>alexdoe</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="profile-info-row">
                                                                                <div class="profile-info-name"> Location </div>

                                                                                <div class="profile-info-value">
                                                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                                    <span>Netherlands, Amsterdam</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="profile-info-row">
                                                                                <div class="profile-info-name"> Age </div>

                                                                                <div class="profile-info-value">
                                                                                    <span>38</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="profile-info-row">
                                                                                <div class="profile-info-name"> Joined </div>

                                                                                <div class="profile-info-value">
                                                                                    <span>2010/06/20</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="profile-info-row">
                                                                                <div class="profile-info-name"> Last Online </div>

                                                                                <div class="profile-info-value">
                                                                                    <span>3 hours ago</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="profile-info-row">
                                                                                <div class="profile-info-name"> About Me </div>

                                                                                <div class="profile-info-value">
                                                                                    <span>Bio</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-3">
                                                                        <div class="space visible-xs"></div>
                                                                        <h4 class="header blue lighter less-margin">Send a message to Alex</h4>

                                                                        <div class="space-6"></div>

                                                                        <form>
                                                                            <fieldset>
                                                                                <textarea class="width-100" resize="none" placeholder="Type something…"></textarea>
                                                                            </fieldset>

                                                                            <div class="hr hr-dotted"></div>

                                                                            <div class="clearfix">
                                                                                <label class="pull-left">
                                                                                    <input type="checkbox" class="ace" />
                                                                                    <span class="lbl"> Email me a copy</span>
                                                                                </label>

                                                                                <button class="pull-right btn btn-sm btn-primary btn-white btn-round" type="button">
                                                                                    Submit
                                                                                    <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                            </tr> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div><!-- /.row -->


                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

       
@endsection
@section('post_script')
<script>
    $('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
    });

   
</script>
@endsection