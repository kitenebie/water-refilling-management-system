<?php use Illuminate\Support\Str; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

	<title>Refill Request</title>
</head>
<body onload="darkmode()">


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="img/header-dashboard.png" alt="" srcset="">
			<span class="text">Refill Transaction</span>
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
				<a href="#">
					<i class='bx bxs-bell' ></i>
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
                <a href="#" class="notification">
                    <i class='bx bxs-bell' ></i>
                    <span class="num">8</span>
                </a>
                <a href="#" class="profile">
                    <img  id="profileimg">
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
							<a class="active order_btn" href="{{ route('refillrequest') }}">Request</a>
						</li>
						<li>
							<a class="active order_btn" href="{{ route('refilltoreceive') }}">ToReceive</a>
						</li>
						<li>
							<a class="active order_btn" href="{{ route('refilltocompleted') }}">Completed</a>
						</li>
						<li>
							<a class="active order_btn" href="#">Cancelled</a>
						</li>
					</ul>
				</div>
				{{--  <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>  --}}
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
						<form action="{{ route('CompleteRequest') }}" method="post">
							@csrf
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
												<td>{{ $refillStatus->created_at = date("M-d-Y") }}</td>
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
													<button type="submit" style="border:none; background:transparent; cursor:pointer">
														<span class="status Completed" style="font-size: .8em; font-weight:600">Complete</span>
													</button>
													@endif
												@endif

												</td>
										   </tr>
									   @endforeach
								   @endif
                            </tbody>
                        </table>
					</form>
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
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
