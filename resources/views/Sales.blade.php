<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

	<title>Sales</title>
</head>
<body onload="darkmode()">


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="img/header-dashboard.png" alt="" srcset="">
			<span class="text">Sales</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="{{ route('dashboard') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li >
				<a href="{{ route('MyService') }}">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Service</span>
				</a>
			</li>
			<li class="active">
				<a href="{{ route('getsalesmonth') }}">
					<i class='bx bxs-chart' ></i>
					<span class="text">Sales</span>
				</a>
			</li>
            @if (session()->get('auth') == 'Admin')
			    <li>
                    <a href="{{ route('orders') }}">
                        <i class='bx bxs-store' ></i>
                        <span class="text">Orders</span>
                    </a>
			    </li>
            @endif

            @if (session()->get('auth') == 'Admin')
            <li>
                <a href="#">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Resellers</span>
                </a>

            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Applicants</span>
                </a>
            </li>
            @endif
            @if (session()->get('auth') == 'Reseller')
            <li>
                <a href="#">
                    <i class='bx bxs-cart' ></i>
                    <span class="text">Request Order</span>
                </a>
            </li>
            @endif
		</ul>
		<ul class="side-menu">
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
					<h1>Sales</h1>
					<ul class="breadcrumb">
						<li>
							<a href="dashboard.html">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="Sales.html">Sales</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<ul class="box-info">
                @if (session()->get('auth') == 'Admin')
                    <li>
                        <i class='bx bxs-calendar-check' ></i>
                        <span class="text">
                            @if (session()->get('auth') == 'Admin')
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

                <script type="text/javascript">
                    window.onload = function () {
                    //************
                    var chart1 = new CanvasJS.Chart("chartContainer1", {
                        theme: "light2", // "light2", "dark1", "dark2"
                        animationEnabled: true, // change to true
                        title: {
                            text: "COD & Walk In Monthly Sales Report (₱) - {{ date('Y') }}"
                        },
                        data: [{
                            // Change type to "bar", "area", "spline", "pie","bubble", 'column'.
                            type: "column",
                            bevelEnabled: false,
                            indexLabelPlacement: 'outside',
                            fillOpacity: 100,
                            dataPoints: [
                                @foreach($Currentsales as $sale)
                                    { label: "{{ DateTime::createFromFormat('!m', $sale->Month)->format('F') }}", y: {{ $sale->TotalSales }} },
                                @endforeach
                            ]
                        }]
                    });
                    chart1.render();

                    //************
                    var chart2 = new CanvasJS.Chart("chartContainer2", {
                        theme: "light2", // "light2", "dark1", "dark2"
                        animationEnabled: true, // change to true
                        title: {
                            text: "Refill Monthly Sales Report (₱) - {{ date('Y') }}"
                        },
                        data: [{
                            // Change type to "bar", "area", "spline", "pie","bubble", 'column'.
                            type: "column",
                            bevelEnabled: false,
                            indexLabelPlacement: 'outside',
                            fillOpacity: 100,
                            dataPoints: [
                                @foreach($refillSALES as $refillsale)
                                    { label: "{{ DateTime::createFromFormat('!m', $refillsale->Month)->format('F') }}", y: {{ $refillsale->TotalSales }} },
                                @endforeach
                            ]
                        }]
                    });
                    chart2.render();

                     //************
                    var chart3 = new CanvasJS.Chart("chartContainer3", {
                        theme: "light2", // "light2", "dark1", "dark2"
                        animationEnabled: true, // change to true
                        title: {
                            text: "General Monthly Sales Report (₱) - {{ date('Y') }}"
                        },
                        data: [{
                            // Change type to "bar", "area", "spline", "pie","bubble", 'column'.
                            type: "column",
                            bevelEnabled: false,
                            indexLabelPlacement: 'outside',
                            fillOpacity: 100,
                            dataPoints: [
                                @foreach($Generalsales as $Generalsale)
                                    { label: "{{ DateTime::createFromFormat('!m', $Generalsale['month'])->format('F') }}", y: {{ $Generalsale['totalAmount'] }} },
                                @endforeach
                            ]
                        }]
                    });
                    chart3.render();
                    //************
                    var chart4 = new CanvasJS.Chart("chartContainer4", {
                        theme: "dark2", // "light2", "dark1", "dark2"
                        animationEnabled: true, // change to true
                        title: {
                            text: "Pending And Process Report (₱) - {{ date('Y') }}"
                        },
                        data: [{
                            // Change type to "bar", "area", "spline", "pie","bubble", 'column'.
                            type: "pie",
                            bevelEnabled: false,
                            indexLabelPlacement: 'outside',
                            fillOpacity: 100,
                            dataPoints: [
                                    { label: "Pending", y: 2565 },
                                    { label: "Process", y: 865 },
                            ]
                        }]
                    });
                    chart4.render();
            }
                </script>


			<div class="table-data">
                <div class="order">
                    <div id="chartContainer1" style="height: 370px; width: 100%; "></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
                    <style>
                        canvas{border-radius: 10px; background: transparent}
                        .canvasjs-chart-credit{display: none}
                        .canvasjs-chart-tooltip{display: none}
                    </style>
                </div>

                <div class="order">
                    <div id="chartContainer2" style="height: 370px; width: 100%; "></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
                    <style>
                        canvas{border-radius: 10px; background: transparent}
                        .canvasjs-chart-credit{display: none}
                        .canvasjs-chart-tooltip{display: none}
                    </style>
                </div>
                <div class="order">
                    <div class="head">
                        <div id="chartContainer3" style="height: 370px; width: 100%; "></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
                        <style>
                            canvas{border-radius: 10px; background: transparent}
                            .canvasjs-chart-credit{display: none}
                            .canvasjs-chart-tooltip{display: none}
                        </style>
                        <div id="chartContainer4" style="height: 370px; width: 40%; "></div>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
                        <style>
                            canvas{border-radius: 10px; background: transparent}
                            .canvasjs-chart-credit{display: none}
                            .canvasjs-chart-tooltip{display: none}
                        </style>
                    </div>
                </div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
