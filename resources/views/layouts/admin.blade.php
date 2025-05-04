<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ALSI SECURITY OFFICIAL WEBSITE">
	<!--favicon-->
	<title>{{ config('app.name', "ALSY SECURITE") }}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{ asset('images/favicon.ico') }}" />
	<!--plugins-->
	<link rel="stylesheet" href="{{ asset('admin/plugins/notifications/css/lobibox.min.css') }}" />
	<link href="{{ asset('admin/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
	<link href="{{ asset('admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('admin/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('admin/css/pace.min.css') }}" rel="stylesheet"/>
	<script src="{{ asset('admin/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('admin/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('admin/css/dark-theme.css') }}"/>
	<link rel="stylesheet" href="{{ asset('admin/css/semi-dark.css') }}"/>
	<link rel="stylesheet" href="{{ asset('admin/css/header-colors.css') }}"/>
	@stack('links')
	<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<x-sidebar-admin></x-sidebar-admin>
		<!--end sidebar wrapper -->
        
		<!--start header -->
		<x-header-admin></x-header-admin>
		<!--end header -->

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
                {{ $slot }}
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		 <div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright &copy; ALSY SECURITE - {{ date('Y') }} | All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->

	<!-- search modal -->
    <x-search-modal></x-search-modal>
    <!-- end search modal -->

	<!--start switcher-->
	<x-switcher></x-switcher>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('admin/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

	<script src="{{ asset('admin/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/notifications/js/notifications.min.js') }}"></script>
	<script src="{{ asset('js/notify.js') }}"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	
	@stack('scripts')
	<!--app JS-->
	<script src="{{ asset('admin/js/app.js') }}"></script>
</body>

</html>