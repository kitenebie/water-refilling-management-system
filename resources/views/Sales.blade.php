<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
    <script src="{{ env('JQUERY_AJAX_URL') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<title>Sales</title>
</head>
<body>
    <style>
        #searchMonth{
            padding: 4px 6px;
            outline: none;
            font-family: inherit;
        }
        #btnshowsales{
            padding: 6px 6px;
            outline: none;
            font-family: inherit;
            font-weight: 700;
            background: rgb(41, 140, 233);
            border: .5px;
            border-radius: 4px;
            color: azure;
            cursor: pointer;
        }        
        #btnshowsales:hover{
            background: rgb(84, 164, 238);
        }
    </style>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="{{ asset('storage/header-dashboard.png') }}" alt="" srcset="">
			<span class="text">Sales</span>
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
			<li  class="active">
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
			    <li>
                    <a href="{{ route('refillrequest') }}">
                        <i class='bx bxs-store-alt' ></i>
                        <span class="text">Refill Request</span>
                    </a>
			    </li>
            @endif

            @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
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
					<input type="checkbox" id="switch-mode" hidden>
                    <i class='bx bxs-bell' ></i>
                    <span class="num"></span>
                </a>
                <a href="#" class="profile">
                    <img src="{{ asset('storage/'.session()->get('profile')) }}" alt="Image">
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
					<i class='bx bxs-file-pdf' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<ul class="box-info">
                <li>
                    <i class='bx bxs-calendar-check' ></i>
                    <span class="text">
                        @if (isset($RecentOrders))
                            <h3><span id="RecentOrders">{{ $RecentOrders }}</span></h3>
                        @endif
                            <p>Orders</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-box' ></i>
                    <span class="text">
                        @if (isset($adminStocks))
                            <h3><span id="adminStocks">{{ $adminStocks }}</span></h3>
                        @endif
                        <p>Stocks</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-coin-stack' ></i>
                    <span class="text">
                        <h3>PHP <span id="yearlySales">{{ $TOTALAMOUNTSALE }}</span></h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>
            <div class="table-data">
                <div class="order">
                    <form action="{{ route('selectedMonthYearSale') }}" method="post"></form>
                    <div>
                        <label for="">Select Year</label>
                        <input type="month" name="searchMonth" id="searchMonth">
                        <button type="submit" id="btnshowsales">Show Slaes</button>
                    </div>
                </div>
            </div>

			<div class="table-data">
                <div class="order">
                    <div class="head">
                        <canvas id="ProductMonthlySales"></canvas>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        <canvas id="RefillMonthlySales"></canvas>
                    </div>
                    <?php
                        $refillsaleMonth = [];
                        $refillTotalSales = [];
                        foreach($refillSALES as $refillsale){
                            $refillsaleMonth[] = DateTime::createFromFormat('!m', $refillsale->Month)->format('F');
                            $refillTotalSales[]= floatval($refillsale->TotalSales);
                        }
                    ?>
                </div>
                <div class="order">
                    <div class="head">
                        <canvas id="GeneralMonthlySales"></canvas>
                    </div>
                    <?php
                        $GensaleMonth = [];
                        $GenTotalSales = [];
                        foreach($Generalsales as $Generalsale){
                            $GensaleMonth[] = DateTime::createFromFormat('!m', $Generalsale['month'])->format('F');
                            $GenTotalSales[]= floatval($Generalsale['totalAmount']);
                        }
                    ?>
                </div>
                <div class="order">
                    <div class="head">
                        <canvas id="Unpayable"></canvas>
                    </div>
                </div>
                <script>
 
                </script>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script>
        const ProductMonthlySales = document.getElementById('ProductMonthlySales');
        Chart.defaults.font.size = 16;
        const ProductMonthlySaleslabels = <?php echo json_encode($productMonth) ?>;
        new Chart(ProductMonthlySales, {
            type: 'bar',
            data: {
                labels: ProductMonthlySaleslabels,
                
            datasets: [{
                label: 'COD & Walk In Monthly Sales Report {{ date("Y") }}-₱',
                data: {{ json_encode($productMontlySales) }},
                backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
        });
        const RefillMonthlySales = document.getElementById('RefillMonthlySales');
        const RefillMonthlySaleslabels = <?php echo json_encode($refillsaleMonth) ?>;
        new Chart(RefillMonthlySales, {
            type: 'bar',
            data: {
                labels: RefillMonthlySaleslabels,
                
            datasets: [{
                label: 'Refill Monthly Sales Report {{ date("Y") }}-₱',
                data: {{ json_encode($refillTotalSales) }},
                backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
        });
        const GeneralMonthlySales = document.getElementById('GeneralMonthlySales');
        const GeneralMonthlySaleslabels = <?php echo json_encode($GensaleMonth) ?>;
        new Chart(GeneralMonthlySales, {
            type: 'bar',
            data: {
                labels: GeneralMonthlySaleslabels,
                
            datasets: [{
                label: 'General Monthly Sales Report {{ date("Y") }}-₱',
                data: {{ json_encode($GenTotalSales) }},
                backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(255, 159, 64)',
                'rgba(255, 205, 86)',
                'rgba(75, 192, 192)',
                'rgba(54, 162, 235)',
                'rgba(153, 102, 255)',
                'rgba(201, 203, 207)'
                ],
                borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            },
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
        });
        const Unpayable = document.getElementById('Unpayable');
        const Unpayablelabels = ["Pending Orders",
                                "Process Orders",
                                "Pending Refill",
                                "Process Refill"];
            new Chart(Unpayable, {
                type: 'doughnut',
                data: {
                    labels: Unpayablelabels,
                    
                datasets: [{
                    label: 'Pending And Process Report {{ date("Y") }}-₱',
                    data: [
                        {{ @$pendingAmount }},
                        {{ @$proccessAmount }},
                        {{ @$refillprending }},
                        {{ @$refillprocess }}
                    ],
                    backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1
                }]
                },
                options: {
                    scales: {
                    y: {
                        beginAtZero: true
                    }
                    },
                }
            });
    </script>
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
@if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
    <script>
        $(document).ready(function(){
			$.ajax({
				url: "{{ route('count_applicants') }}",
				success: function(Appdata) {
                    $('.num').text(Appdata);
				}
				});
		});
    </script>
@endif
    {{-- amounts.js --}}
	<script src="{{ asset('js/amounts.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
