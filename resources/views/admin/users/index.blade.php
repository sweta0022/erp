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
                    <li class="active"> Total Users (0) </li>
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

                <div class="page-header">
                <div class="text-right">
                        <a href="{{url('user/create')}}" class="btn btn-primary" style="margin-right: 45px;" >Add User</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone no</th>
                                            <th class="hidden-480">Role</th>
                                            <th class="hidden-480">Seniors</th>
                                            <th class="hidden-480">State</th>
                                            <th class="hidden-480">City</th>
                                            <th class="hidden-480">Zone</th>
                                            <th class="hidden-480">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($users as $key => $usersV)
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
                                                    <a href="#">{{$usersV->name}}</a>
                                                </td>
                                                <td>{{$usersV->email}}</td>
                                                <td class="hidden-480">{{$usersV->phone_no}}</td>
                                                <td>{{$usersV->role->name}}</td>
                                                <td> @foreach($usersV->senior as $value) {{$value->username($value->senior_id)->name}}, @endforeach</td>
                                                <td>{{$usersV->state->name}}</td>
                                                <td>{{$usersV->city->name}}</td>
                                                <td>{{$usersV->zone->name}}</td>
                                                <td class="hidden-480">
														<span class="label label-sm label-{{($usersV->status)?'success':'danger'}}"> {{($usersV->status)?'Active':'Deactive'}} </span>
												</td>

                                                <td>
                                                    <div class="hidden-sm hidden-xs btn-group">
                                                      
                                                        <a href="{{url('user/status/change')}}/{{$usersV->id}}" title="Change Status"  class="btn btn-xs btn-{{($usersV->status)?'danger':'success'}}">
                                                            <i class="ace-icon fa fa-{{($usersV->status)?'close':'check'}} bigger-120"></i></a> 

                                                        <a href="{{url('user/edit')}}/{{$usersV->id}}" title="Edit"  class="btn btn-xs btn-info">
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