<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

	<title>Dashboard</title>
</head>
<body onload="darkmode()">


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="img/header-dashboard.png" alt="" srcset="">
			<span class="text">Dashboard</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
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
            @endif

            @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
            <li>
                <a href="#">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Resellers</span>
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
				<a href="#">
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
                <label for="switch-mode" class="switch-mode"></label>
                <a href="#" class="notification">
                    <i class='bx bxs-bell' ></i>
                    <span class="num">8</span>
                </a>
                <a href="#" class="profile">
                    <img src="{{ env('IMG_PROF') }}">
                </a>
            </div>
		</nav>
		<!-- NAVBAR -->


		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="#">Dashboard</a>
						</li>
					</ul>
				</div>
				{{--  <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>  --}}
			</div>

			<ul class="box-info">
                @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                    <li>
                        <i class='bx bxs-calendar-check' ></i>
                        <span class="text">
                            @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                <h3>0</h3>
                                <p>New Orders</p>
                            @else
                                <h3>0</h3>
                                <p>New Orders</p>
                            @endif
                        </span>
                    </li>
                @endif
                <li>
                    <i class='bx bxs-box' ></i>
                    <span class="text">
                        <h3>{{ session()->get('totalStock') }}</h3>
                        <p>Stocks</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-coin-stack' ></i>
                    <span class="text">
                        <h3>PHP {{ session()->get('totalUserAmount') }}</h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Orders</h3>
                        <form action="#">
                            <div class="form-input2">
                                <input type="search" placeholder="Search..." class="recent-search">
                                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                            </div>
                        </form>
					</div>
                    <table>
                        {{--  <thead>
                            <tr>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->Year }}</td>
                                    <td>{{ $sale->Month }}</td>
                                    <td>{{ $sale->TotalSales }}</td>
                                </tr>
                            @endforeach
                        </tbody>  --}}
                    </table>
				</div>
				<div class="todo">
                    @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
					<div class="head">
						<h3>Applying Reseller <i class='bx bxs-bell'></i><span id="count" style="color:red; position: absolute; top:0; font-size:.8rem"></span></h3>
					</div>
					<ul class="todo-list" id="#container">
                        @if (isset($reqData))
                            @foreach ($reqData as $ReqDAta)
                                <li class="completed relative" id="req">
                                    <a href="RequestNotification/{{ $ReqDAta->reseller_id }}" style="color:inherit">
                                        <p>
                                            <b>{{ $ReqDAta->lastname }}. {{ $ReqDAta->firstname }}</b>, from
                                            <b>{{ $ReqDAta->address }}</b> is waiting For your Response for applying as one of your reseller.
                                        </p>
                                        {{--  <i class='bx bx-dots-vertical-rounded' ></i>  --}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
					</ul>
                    @endif
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script>
        $(document).ready(function() {
            // Get the number of elements with id="requesting"
            var count = $('#req').length;

            // Set the text of the span element to the count
            $('#count').text(count);
        });
        </script>

        <!-- Scripts -->
        <script src="js/scripts.js"></script> <!-- Custom scripts -->
        <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
        <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
        <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>

        @if (session('success'))
        <input hidden type="text" value="{{ session()->get(env('USER_SESSION_AUTHENTICATION_NAME')) }}" id="welcomeMSG">
        <script>
            toastr.success('Welcome, ' + $('#welcomeMSG').val() + '!', "Login Successfully", {
                closeButton: true,
                tapToDismiss: true, // prevent the toast from disappearing when clicked
                newestOnTop: true,
                positionClass: 'toast-top-right', // set the position of the toast
                preventDuplicates: true,
            }, 5000);
        </script>
        @endif
</body>
</html>
