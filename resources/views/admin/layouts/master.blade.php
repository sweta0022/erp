<!DOCTYPE html>
<html lang="en">
	<head>
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
			<meta charset="utf-8" />
			<title>Top Menu Style - Ace Admin</title>

			<meta name="description" content="top menu &amp; navigation" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

			<!-- bootstrap & fontawesome -->
			<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
			<link rel="stylesheet" href="{{ asset('') }}" />
			<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

			<!-- page specific plugin styles -->
			
			<!-- text fonts -->
			<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

			<!-- ace styles -->
			<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

			<!--[if lte IE 9]>
				<link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
			<![endif]-->
			<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
			<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

			<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
			<![endif]-->

			<!-- inline styles related to this page -->

			<!-- ace settings handler -->
			<script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

			@if(Route::currentRouteName() == "create-user")
				<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
			@endif

			<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

			<!--[if lte IE 8]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
			<![endif]-->
			@yield('post_css')
	</head>

	<body class="no-skin">
         @include("admin.partials.navbar")		

		 <div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

            @include("admin.partials.sidebar")
			

			@yield('content')

            @include("admin.partials.footer")         
			

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

        @include("admin.partials.script")
		@yield('post_script')
	
	</body>
</html>
