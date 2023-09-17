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
    <script src="{{ env('JQUERY_AJAX_URL') }}"></script>

</head>
<body>
    <script>
    $(document).ready(function() {
	if (!Notification) {
		$('body').append('<h4 style="color:red">*Browser does not support Web Notification</h4>');
		return;
	}
	if (Notification.permission !== "granted") {
		Notification.requestPermission();
	} else {
		$.ajax({
			url : "{{ route('getNotificationByUser') }}",
			type: "get",
			success: function(response, textStatus, jqXHR) {
				var response = jQuery.parseJSON(response);
				if(response.result == true) {
					var notificationDetails = response.notif;
					for (var i = notificationDetails.length - 1; i >= 0; i--) {
						var notificationUrl = notificationDetails[i]['url'];
						var notificationObj = new Notification(notificationDetails[i]['title'], {
							icon: notificationDetails[i]['icon'],
							body: notificationDetails[i]['message'],
						});
						notificationObj.onclick = function () {
							window.open(notificationUrl);
							// notificationObj.close();
						};
						// setTimeout(function(){
						// 	notificationObj.close();
						// });
					};
				} else {
				}
			},
			error: function(jqXHR, textStatus, errorThrown)	{}
		});
	}
});
    </script>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="{{ asset('images/header-dashboard.png') }}" alt="" srcset="">
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
					<span class="text">Products</span>
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
			    <li>
                    <a href="{{ route('refillrequest') }}">
                        <i class='bx bxs-store-alt' ></i>
                        <span class="text">Refill Request</span>
                    </a>
			    </li>
            @endif

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
					<div class="head">
						<h3>Recent Orders</h3>
                        {{-- <form action="#">
                            <div class="form-input2">
                                <input type="search" placeholder="Search..." class="recent-search">
                                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                            </div>
                        </form> --}}
					</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Product</th>
                                <th>order</th>
                                <th>Total</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($orders_DATA))
                                @foreach ($orders_DATA as $personInfo)
                                    <tr>
                                        <td>{{ $personInfo->firstname }}, {{ $personInfo->lastname }}</td>
                                        <td>{{ $personInfo->product_Name }}</td>
                                        <td>{{ $personInfo->order }}</td>
                                        <td id="amount">{{ $personInfo->Amount }}</td>
                                        <td><span class="status Pending" style="font-size: .8em; font-weight:600">{{ $personInfo->status }}</span></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
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
                    @if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                    <div class="order">
                        <div class="head">
                            {{-- box4 --}}
                            <h4>Notifications</h4>
                        </div>
                        <div class="todo box">
                            <ul class="todo-list" id="anncontainer">
                            </ul>
                        </div>
                    </div>
                    @endif
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


    <!-- Scripts -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
	<script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ env('JQUERY_AJAX_URL') }}"></script>
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>
    <script src="{{ env('TOASTR_JQUERY_LINK') }}"></script>
    <script>
        $('document').ready(function(){
            $('td[id^="amount"]').each(function() {
                var amount = $(this).text();
                $(this).text(amount.toFixed(2));
                });
        })
    </script>
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

@if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
	<script>
		$(document).ready(function(){
			$.ajax({
				url: "{{ route('get_annoucement') }}",
				success: function(data) {
					// Get the response data
					var response = data;

					// Do something with the response data
					// console.log(response);
					// console.log(response.length);
                        $('.num').text(response.length);
					for(var i = 0; i < response.length; i++){
						// console.log(response[i].announce_Code)
                        const dateString = response[i].created_at;
                        // Convert the date string to a Date object
                        const date = new Date(dateString);

                        // Get the current time
                        const now = new Date();

                        // Calculate the difference between the two dates
                        const difference = now - date;

                        // Convert the difference to hours
                        const hours = difference / 3600;
                        agoString = `${date.toLocaleString("en-US")}`;
						$('#anncontainer').append('<li class="completed"><div><strong style="color: grey;"><span> '+ agoString +' </span></strong><p style="text-align:justify">'+response[i].annoucements_content+'</p></div></li>')
					}
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
        <script src="{{ asset('js/amounts.js') }}"></script>
        <script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
