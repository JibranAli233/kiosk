<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Kiosk</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('assets/img/salesemergefav.png') }}" type="image/x-icon"/>
	<!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script src="{{asset('libs/jquery.min.js')}}" ></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{ asset("assets/css/fonts.css") }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/azzara.min.css') }}">
	<script src="{{ asset('assets/js/sweetalert2.all.js') }}" ></script>

    
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	<style>
        .swal2-cancel{
            margin-right:5px;
        }
        .select2-container{
            width:250px !important;
            /* width:100% !important; */

        }
        .span_danger{
            color:red;
        }
        .table>tbody>tr>td{ white-space: nowrap !important;   padding: 2px; !important;}
        .table td, .table th { padding: 0.25rem!important; }


		.span_danger{
			color:red;
		}

		.add_image{
			position: relative;
		}
		.add_image label {
			position: absolute;
			top: 0;
			right: -5px;
			max-width: 10px;
			margin: 0;
		}
		.add_image input {
			opacity: 0;
			width: 0;
			height: 0;
		}
	      html,body{
	        height: 100%;
	      }
	      .loader{
	        display: none;
	      }


		   /* width */
		   ::-webkit-scrollbar {
            width: 10px;
            /* border-radius: 1em; */
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* border-radius: 1em; */

        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 1em;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* border-radius: 1em; */
        }

        .select2-container--default .select2-selection--single {
            border: 0 solid #aaa !important;
        }
        .select2{
            display: block;
            width: 100% !important;
            padding: 0.2rem 0.8rem !important;
            font-size: 11px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ebedf2 !important;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
        }


	</style>
</head>
<body>
	<div class="wrapper">
		<!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="purple">
			<!-- Logo Header -->
			<div class="logo-header">

				<a href="{{url('/home')}}" class="logo">
					<img src="{{ asset('assets/img/icons.png') }}" alt="navbar brand" class="navbar-brand" style="width: 70%;">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">


				<div class="container-fluid" >
                    <div style="color:white; font-weight:bold;font-size:24px; text-transform: uppercase;">
                        {{isset(Auth::user()->company->name) ? Auth::user()->company->name : ""}}
                    </div>
                    <div class=" text-right" style="color:white; font-weight:bold;font-size:24px; text-transform: uppercase; margin-left:auto">
                        {{-- {{isset(Auth::user()->branch->name) ? Auth::user()->branch->name : ""}} --}}
                    </div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
                                    <img src="{{ Auth::user()->profile_pic }}" alt="image profile" class="avatar-img rounded" style="width: 100%;height: 100%;">

								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
                                        <img src="{{ Auth::user()->profile_pic }}" alt="image profile" class="avatar-img rounded" style="width: 40%;height: 100%;">
										<div class="u-text">
											<h4>{{Auth::user()->name}} ttt</h4>
											<p class="text-muted">{{Auth::user()->email}}</p><a href="{{route('profiles.edit', Auth::user()->id)}}" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
										<i class="nav-icon fas fa-power-off"></i>
										{{ __('Logout') }}
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>

								</li>
							</ul>
						</li>

					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<?php
			function url_explode($url){
				$explodedUrl = explode("/", $url);
				if(is_array($explodedUrl)){

					if (count($explodedUrl) > 0)
					{
						$main = $explodedUrl[0];
						$state = "active";
						return $main;
					}
				}
			}
		?>
		<!-- Sidebar -->
		<div class="sidebar">

			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
                            <img src="{{ Auth::user()->profile_pic }}" alt="image profile" class="avatar-img rounded" style="width: 100%;height: 100%;">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
                                    {{Auth::user()->name}}
									<span class="user-level">
                                        {{isset(Auth::user()->branch->name) ? Auth::user()->branch->name : ""}} <br>
                                        {{isset(Auth::user()->email) ? Auth::user()->email : ""}}

                                        {{-- {{isset(Auth::user()->branch->name) ? Auth::user()->branch->name : ""}},
                                        {{isset(Auth::user()->company->name) ? Auth::user()->company->name : ""}} --}}
                                    </span>
								</span>
							</a>
                            <div class="clearfix"></div>
						</div>
					</div>
                    <?php
                        $company_id = isset( Auth::user()->company_id) ?  Auth::user()->company_id : 0;
                    ?>
					<ul class="nav" id="accordion">

                        <li class="nav-item  @if('home' == url_explode(request()->path()) ) {{'active'}} @endif">
							<a href="{{url('/home')}}">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
                        
                        <!-- User Setup  -->
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#user_setup" class="collapsed" aria-expanded="false">
                                <i class="fas fa-users-cog"></i>
                                <p>User Setup</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="user_setup" style="">
                                <ul class="nav nav-collapse">

                                    @can('user-list')
                                        <li class="nav-item @if('users' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{url('/users')}}">
                                                <span class="sub-item">Users</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('role-list')
                                        <li class="nav-item @if('roles' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{url('/roles')}}">
                                                <span class="sub-item">Roles</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('profile-edit')
                                        <li class="nav-item @if('users' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{route('profiles.edit', Auth::user()->id)}}">
                                                <span class="sub-item">Change password</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                        
                        <!-- Item Setup -->
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#item" class="collapsed" aria-expanded="false">
                                <i class="fas fa-layer-group"></i>
                                <p>Item Setup</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="item" style="">
                                <ul class="nav nav-collapse">
                             
                                    @can('item-list')
                                        <li class="nav-item @if('items' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{url('/items')}}">
                                                <span class="sub-item">Items</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('category-list')
                                        <li class="nav-categorie @if('categories' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{url('/categories')}}">
                                                <span class="sub-item">Categories</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('manufacturer-list')
                                        <li class="nav-categorie @if('manufacturers' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{url('/manufacturers')}}">
                                                <span class="sub-item">Manufacturers</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a data-toggle="collapse" href="#Purchase&Sell" class="collapsed" aria-expanded="false">
                                <i class="fas fa-shopping-cart"></i>
                                <p>Purchase & Sell</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="Purchase&Sell" style="">
                                <ul class="nav nav-collapse">
                                    
                                    @can('purchase-list')
                                        <li class="nav-item @if('purchases' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{url('/purchases')}}">
                                                <!-- <i class="fas fa-shopping-cart"></i> -->
                                                <span class="sub-item">Purchase stock</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('sell-list')
                                        <li class="nav-item @if('sells' == url_explode(request()->path()) ) {{'active'}} @endif">
                                            <a  href="{{url('/sells')}}">
                                                <!-- <i class="fas fa-shopping-cart"></i> -->
                                                <span class="sub-item">Sell stock</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                        @can('stock-list')
                            <li class="nav-item @if('stocks' == url_explode(request()->path()) ) {{'active'}} @endif">
                                <a  href="{{url('/stocks')}}">
									<i class="fas fa-store"></i>
									<p>Stock</p>
                                </a>
                            </li>
                        @endcan
                        
                        @can('report-list')
							<li class="nav-item @if('reports' == url_explode(request()->path()) ) {{'active'}} @endif">
								<a  href="{{url('/reports')}}">
									<i class="fas fa-file"></i>
									<p>Report</p>
								</a>
							</li>
						@endcan
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                @yield('content')
			</div>
		</div>
	</div>
    <div id= "spinner-div"
         style="width:100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: rgba(0,0,0,0.2);
            z-index:9999;
            display:none;"><i class="fas fa-spinner fa-spin" style="position:absolute; left:50%; top:50%;font-size:80px; color:#3a7ae0"></i> </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <script src="{{asset('libs/datatable/jquery.dataTables.min.js')}}" defer></script>
    <script src="{{asset('libs/datatable/dataTables.bootstrap4.min.js')}}" defer></script>
    <script src="{{asset('libs/jquery.validate.js')}}" defer></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets/js/plugin/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    {{--<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>--}}
        <script src="{{ asset('libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('libs/datatable/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('libs/datatable/dataTables.buttons.min.js') }}"></script>
    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{ asset('assets/js/plugin/gmaps/gmaps.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Azzara JS -->
    <script src="{{ asset('assets/js/ready.min.js') }}"></script>

    <!-- Azzara DEMO methods, don't include it in your project! -->
    <!-- <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script> -->


    <script type="text/javascript">
        $(document).ready(function () {

            $('.nav-item a[data-toggle="collapse"]').on('click', function () {
                // Remove the 'active' class from all nav items
                $('.nav-item').removeClass('submenu');

                // Add the 'active' class to the clicked nav item
                $(this).closest('.nav-item').addClass('submenu');

                // Collapse all other collapsible elements
                $('.nav-item a[data-toggle="collapse"]').not(this).each(function () {
                    $($(this).attr('href')).collapse('hide');
                });

                // Collapse all other multi-level elements
                $('.nav-item .collapse.show').not($(this).siblings('.collapse')).collapse('hide');
            });


            $(document).on('click','.delete_all', function(e) {
                var id = $(this).data('id');
                    var allVals = [];
                        allVals.push($(this).attr('data-id'));

                if(allVals.length <=0)
                {
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select row!',
                    // footer: '<a href>Why do I have this issue?</a>'
                    })
                }  else {

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        // console.log(result.value);
                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $('#myTable').DataTable().ajax.reload();

                                    swalWithBootstrapButtons.fire(
                                        'Deleted!',
                                        data['success'],
                                        'success'
                                    )

                                } else if (data['error']) {
                                    // alert(data['error']);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: data['error'],
                                    })
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                var msg;
                                if (data.responseJSON && data.responseJSON.msg) {
                                msg = data.responseJSON.msg;
                                } else {
                                msg = data;
                                }
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: msg,
                                    });
                                // alert(data.responseText);
                            }
                        });

                        } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                        ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your imaginary data is safe :)',
                            'error'
                        )
                        }
                    })
                }
            });
        });
    </script>

    <script>
        $(function() {
            let copyButtonTrans = 'Copy'
            let csvButtonTrans = 'CSV'
            let excelButtonTrans = 'Excel'
            let pdfButtonTrans = 'PDF'
            let printButtonTrans = 'Print'
            let colvisButtonTrans = 'Columns'
            let selectAllButtonTrans = 'Select all'
            let selectNoneButtonTrans = 'Deselect all'

            let languages = {
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
                'fr': 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json',
                'zh-Hans': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Chinese.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: languages['{{ app()->getLocale() }}']
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                select: {
                    style:    'multi+shift',
                    selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 100,
                dom: 'lBfrtip<"actions">',
                buttons: [
                    {
                        extend: 'selectAll',
                        className: 'btn-primary',
                        text: selectAllButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        },
                        action: function(e, dt) {
                            e.preventDefault()
                            dt.rows().deselect();
                            dt.rows({ search: 'applied' }).select();
                        }
                    },
                    {
                        extend: 'selectNone',
                        className: 'btn-primary',
                        text: selectNoneButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-default',
                        text: csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $.fn.dataTable.ext.classes.sPageButton = '';
        });

    </script>
    <!-- syedhaaris97 Personal -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    <script src="{{ asset('assets/js/hunt.js')}}"></script>
    @yield('scripts')
</body>
</html>
