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
			<img style="margin: 5px" width="50px" height="50px" src="{{ asset('images/header-dashboard.png') }}" alt="" srcset="">
			<span class="text">Dashboard</span>
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
					<span class="text">Products</span>
				</a>
			</li>
            @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
			    <li>
                    <a href="{{ route('refillrequest') }}">
                        <i class='bx bxs-store-alt' ></i>
                        <span class="text">Refill Request</span>
                    </a>
			    </li>
			    <li>
                    <a href="{{ route('orders') }}">
                        <i class='bx bxs-store' ></i>
                        <span class="text">Orders</span>
                    </a>
			    </li>
            @endif
            @if (session()->get('auth') == 'Reseller')
            <li>
                <a href="{{ route('refillrequest') }}">
                    <i class='bx bxs-store-alt' ></i>
                    <span class="text">Refill Request</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders') }}">
                    <i class='bx bxs-cart' ></i>
                    <span class="text">Request Order</span>
                </a>
            </li>
            @endif
			<li class="active">
				<a href="{{ route('getsalesmonth') }}">
					<i class='bx bxs-chart' ></i>
					<span class="text">Sales</span>
				</a>
			</li>

            @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
            <li>
                <a href="{{ route('members') }}">
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
				<a href="/getyearlyReport/@if(isset($thisyear)){{ $thisyear }}@else{{ date('Y') }}@endif" class="btn-download">
					<i class='bx bxs-file-pdf' ></i>
					<span class="text">Download PDF
                        @if(isset($thisyear))
                            {{ $thisyear }}
                        @else
                            {{ date('Y') }}
                        @endif
                    </span>
				</a>

			</div>

            <div class="table-data">
                <div class="order">
                        <form action="{{ route('submitFindSaleyear') }}" method="post">
                        @csrf
                        <div>
                        @if(isset($existingYears))
                        <Select id="yearSale" name="yearSale" class="inputs-products" style="border-radius: 2px !important">
                            @foreach ($existingYears as $exestYEAR)
                                <option value="{{ $exestYEAR }}">Sales Report of Year <b>{{ $exestYEAR }}</b></option>
                            @endforeach
                            @if(isset($thisyear))
                                <option disabled style="color:grey" selected value="{{ $thisyear }}">Sales Report of Year <b>{{ $thisyear }}</b></option>
                            @endif
                        </Select>
                        <button type="submit" id="btnshowsales">Show Sales</button>
                        @endif
                        </div>
                    </form>
                </div>
                <div class="order" style="display: flex !important">
                    @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                    <form action="{{ route('getAllBetweenSales') }}" method="post"
                        style="display: flex; flex-direction:column; justify-content:start; align-items:start"
                    >
                    @endif
                    @if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                    <form action="{{ route('SellerWalkIngetAllBetweenSales') }}" method="post"
                        style="display: flex; flex-direction:column; justify-content:start; align-items:start"
                    >
                    @endif
                    @csrf
                        <label for="">Start: </label>
                        <input onchange="copytext()" type="date" id="dateStart" name="dateStart" class="inputs-products" placeholder="e.g., 10" value="0">
                        <label for="">End: </label>
                        <input onchange="copytext()" type="date" id="dateEnd" name="dateEnd" class="inputs-products" placeholder="e.g., 10" value="0">
                        <div>
                            <button type="submit" style="margin-top: 5px; margin-left: 5px" id="btnshowsales">Show chart Sales</button>
                            <a id="data" onclick="copytext()" href="#">
                                <button type="button" style="margin-top: 5px; margin-left: 5px" id="btnshowsales">Show Table Sales</button>
                            </a>
                        </div>
                </div>
            </div>
            <script>
                // Get the current date as a string in the format yyyy-mm-dd
                function getCurrentDate() {
                    const today = new Date();
                    const year = today.getFullYear();
                    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
                    const day = String(today.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }
        
                // Set the input field value to the current date
                document.getElementById('dateStart').max = getCurrentDate();
                document.getElementById('dateEnd').max = getCurrentDate();
                document.getElementById('dateStart').value = getCurrentDate();
                document.getElementById('dateEnd').value = getCurrentDate();
                function copytext(){
                    const dateStart = document.getElementById('dateStart').value;
                    const dateEnd = document.getElementById('dateEnd').value;
                    const href = `/Sales-report/${dateStart}/${dateEnd}`;
                    document.getElementById('data').href = href;
                }
            </script>
            @if(isset($startDate))
                <script>
                    document.getElementById('dateStart').value = '{{ $startDate }}';
                    document.getElementById('dateEnd').value = '{{ $endDate }}';
                </script>
            @endif
            @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                <div class="table-data">
                    <div class="order">
                        <h3>Cash on Delivery Sales @if(isset($dateRange)){{ $dateRange }}@endif</h3>
                        <div class="head" width="100" height="100">
                            <canvas id="codSales"></canvas>
                        </div>
                    </div>
                </div>
            @endif
			<div class="table-data">
                <div class="order">
                    @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                    <h3>Walk In Sales @if(isset($dateRange)){{ $dateRange }}@endif</h3>
                    @else
                    <h3>Product and Refill Sales @if(isset($dateRange)){{ $dateRange }}@endif</h3>
                    @endif
                    <div class="head">
                        <canvas id="walkinsale"></canvas>
                    </div>
                </div>
			</div>
			<div class="table-data">
                <div class="order">
                    <h3>Pending And Process Report</h3>
                    <div class="head">
                        <canvas id="Unpayable"></canvas>
                    </div>
                </div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="{{ asset('js/dashboard.js') }}"></script>
    @if(isset($WalkInallrefillDates))
        <script>
            const dateRangewalkinsale = document.getElementById('walkinsale');
            Chart.defaults.font.size = 14;
            const dateRangewalkinsalelabels = <?php echo json_encode($WalkInallrefillDates) ?>;
            new Chart(dateRangewalkinsale, {
                    data: {
                    datasets: [{
                        type: 'bar',
                        label: 'Product Sales',
                        data: <?php echo json_encode($WalkInallSalesTotal) ?>,
                        backgroundColor: [
                        'rgba(255, 99, 132)',],
                    }, {
                        type: 'bar',
                        label: 'Refill Sales',
                        data: <?php echo json_encode($WalkInallrefillSalesTotal) ?>,
                        backgroundColor: [
                        'rgba(75, 192, 192)']
                }, {
                        type: 'bar',
                        label: 'Over All Sales',
                        data: <?php echo json_encode($walkInOverALLtotalAmount) ?>,
                        backgroundColor: [
                        'rgba(54, 162, 235)']
                }],
                    labels: dateRangewalkinsalelabels
                },
                options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });
        </script>
    @endif
    @if(isset($COD_InallrefillDates) && session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
        <script>
            const dateRangedateRangeCODsale = document.getElementById('codSales');
            Chart.defaults.font.size = 14;
            const dateRangedateRangeCODsalelabels = <?php echo json_encode($COD_InallrefillDates) ?>;
            new Chart(dateRangedateRangeCODsale, {
                    data: {
                    datasets: [{
                        type: 'bar',
                        label: 'Product Sales',
                        data: <?php echo json_encode($COD_InallSalesTotal) ?>,
                        backgroundColor: [
                        'rgba(255, 99, 132)',],
                    }, {
                        type: 'bar',
                        label: 'Refill Sales',
                        data: <?php echo json_encode($COD_InallrefillSalesTotal) ?>,
                        backgroundColor: [
                        'rgba(75, 192, 192)']
                }, {
                        type: 'bar',
                        label: 'Over All Sales',
                        data: <?php echo json_encode($COD_InOverALLtotalAmount) ?>,
                        backgroundColor: [
                        'rgba(54, 162, 235)']
                }],
                    labels: dateRangedateRangeCODsalelabels
                },
                options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            }
            });
        </script>
    @endif

	<script>
        const Unpayable = document.getElementById('Unpayable');
        const Unpayablelabels = ["Pending Orders",
                                "Process Orders",
                                "Pending Refill",
                                "Process Refill"];
            new Chart(Unpayable, {
                type: 'line',
                data: {
                    labels: Unpayablelabels,

                datasets: [{
                    label: '',
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
                    'rgba(255, 99, 132)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)'
                    ],
                    borderWidth: 5,
                    pointBorderWidth: 25,
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
    {{-- amounts.js --}}
	<script src="{{ asset('js/amounts.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>






</body>
</html>
