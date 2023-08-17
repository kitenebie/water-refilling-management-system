@php
	use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
	<script src="{{ env('JQUERY_AJAX_URL') }}"></script>
	<title>Refill Request</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="{{ asset('images/header-dashboard.png') }}" alt="" srcset="">
			<span class="text">Order & Transaction</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="{{ route('dashboard') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ route('MyService') }}">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Service</span>
				</a>
			</li>
			<li>
				<a href="{{ route('getsalesmonth') }}">
					<i class='bx bxs-chart' ></i>
					<span class="text">Sales</span>
				</a>
			</li>
            @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
			    <li>
                    <a href="{{ route('orders') }}">
                        <i class='bx bxs-store' ></i>
                        <span class="text">Orders</span>
                    </a>
			    </li>
			    <li  class="active">
                    <a href="{{ route('refillrequest') }}">
                        <i class='bx bxs-store-alt' ></i>
                        <span class="text">Refill Request</span>
                    </a>
			    </li>
				<li>
					<a href="#">
						<i class='bx bxs-user-account' ></i>
						<span class="text">Members</span>
					</a>
				</li>
				<li>
					<a href="{{ route('applicantRequest') }}">
						<i class='bx bxs-group' ></i>
						<span class="text">Applicants</span>
					</a>
				</li>
            @endif
            @if (session()->get('auth') == 'Reseller')
            <li>
                <a href="{{ route('orders') }}">
                    <i class='bx bxs-cart' ></i>
                    <span class="text">Request Order</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('refillrequest') }}">
                    <i class='bx bxs-store-alt' ></i>
                    <span class="text">Refill Transaction</span>
                </a>
            </li>
            @endif
		</ul>
		<ul class="side-menu">
			<li>
				<a href="{{ route('ShowPostNotification') }}">
					<i class='bx bxs-bell'></i>
					<span class="text">Notification</span>
				</a>
			</li>
			<li>
				<a href="{{ route('Settings') }}">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="{{ route('logout') }}" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

    <!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
            <div style="width: 100%; display: flex; align-items:center; gap: 10px; justify-content: end">
                <input type="checkbox" id="switch-mode" hidden>
                <a href="{{ route('ShowPostNotification') }}" class="notification">
					<input type="checkbox" id="switch-mode" hidden>
                    <i class='bx bxs-bell' ></i>
                    <span class="num"></span>
                </a>
            </div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Refill Transactions</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active order_btn" @if ($label_title == "Pending Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refillrequest') }}">Request</a>
						</li>
						<li>
							<a class="active order_btn" @if ($label_title == "Process Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refilltoreceive') }}">ToReceive</a>
						</li>
						<li>
							<a class="active order_btn" @if ($label_title == "Completed Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refilltocompleted') }}">Completed</a>
						</li>
						<li>
							<a class="active order_btn" @if ($label_title == "Cancelled Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refilltocancelled') }}">Cancelled</a>
						</li>
					</ul>
				</div>
				{{--  <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>  --}}
			@if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
				@if ($label_title == "Process Refill Request")
				<li>
					<a  href="{{ route('get_toReceive_refill') }}" class="save-btn" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-wigth:700">
						<i class='bx bxs-download' ></i>
						<span class="text"> Process Report</span>
					</a>
				</li>
				@endif

				@if ($label_title == "Completed Refill Request")
				<li>
					<a  href="{{ route('get_complete_refill') }}" class="save-btn" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-wigth:700">
						<i class='bx bxs-download' ></i>
						<span class="text"> Complete Report {{ date('F-Y') }}</span>
					</a>
				</li>
				@endif
			@endif
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
                       @if(isset($label_title))
						<h1>{{ $label_title }}</h1>
						@endif
                    </div>
                    <div class="table-data">
                        <table>
                            <thead>
                                <tr>
                                    <th>Seller ID</th>
                                    <th>Seller Name</th>
                                    <th>No. of Gallon</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                   @if (isset($statusRefill))
									   @foreach ($statusRefill as $refillStatus)
										   <tr>
												<td>
													<input value="{{ $refillStatus->id }}" type="text" name="id" id="id" hidden>
													{{ str::mask($refillStatus->Reseller_ID,'X',7,5) }}
												</td>
												<td>{{ $refillStatus->lastname }}, {{ $refillStatus->firstname }}</td>
												<td>
													{{ $refillStatus->NumberOfGallon }}
													<input value="{{ $refillStatus->NumberOfGallon }}" type="text" name="Quantity" id="Quantity" hidden>
												</td>
												<td>
													{{ $refillStatus->TotalCost }}
													<input value="{{ $refillStatus->TotalCost }}" type="text" name="Amount" id="Amount" hidden>
												</td>
												<td>
												{{ \Carbon\Carbon::parse($refillStatus->updated_at)->format('F j, Y') }}

												</td>
												<td>
													@if ($label_title == "Pending Refill Request")
                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                                    <a href="/Refill-request/Request/Accept/{{ $refillStatus->id }}">
                                                    <span class="status Completed" style="font-size: .8em; font-weight:600">Accept</span>
                                                    </a>
                                                    <a href="/Refill-request/Request/Decline/{{ $refillStatus->id }}">
                                                        <span class="status Cancelled" style="font-size: .8em; font-weight:600">Decline</span>
                                                    </a>
                                                    @endif

                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                                                        <a href="/Refill-request/Request/Decline/{{ $refillStatus->id }}">
                                                            <span class="status Cancelled" style="font-size: .8em; font-weight:600">Cancel Order</span>
                                                        </a>
                                                    @endif
                                                @endif

												@if ($label_title == "Process Refill Request")
													@if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
													<a href="/Refill-request/Request/complete/{{ $refillStatus->id }}/{{ $refillStatus->NumberOfGallon }}/{{ $refillStatus->TotalCost }}" style="border:none; background:transparent; cursor:pointer">
														<span class="status Completed" style="font-size: .8em; font-weight:600">Complete</span>
													</a>
													@endif
												@endif

												</td>
										   </tr>
									   @endforeach
								   @endif
                            </tbody>
                        </table>

                    </div>
				</div>
			</div>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <!-- Scripts -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>

    @if (session('Cancelled'))
    <script>
        toastr.warning("Request has been cancelled", "Refill Request Cancelled", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
	{{-- Accepted --}}
	@if (session('Accepted'))
    <script>
        toastr.success('Refill Request has been accepted', "Accepted!", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
	{{-- Completed --}}
	@if (session('Completed'))
    <script>
        toastr.success('Refill Request has been Completed', "Completed!", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
	@if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
	<script>
		$(document).ready(function(){
			$.ajax({
				url: "{{ route('get_annoucement') }}",
				success: function(data) {
					var response = data;
                    $('.num').text(response.length);
				}
				});
		});
	</script>
@endif

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "{{ route('count_notif') }}",
                success: function(Appdata) {
                    $('.num').text(Appdata);
                }
                });
        });
    </script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
