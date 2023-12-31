
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
	<title>Notification</title>
    <script src="{{ env('JQUERY_AJAX_URL') }}"></script>
</head>
<body>

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
				<li>
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
				<li class="active">
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
					<h1>Notification</h1>
					<ul class="breadcrumb">
						<li>
							<a href="dashboard.html">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Notification</a>
						</li>
					</ul>
				</div>

			<div class="table-data">
                <div class="order">
                    <div class="head">
                        {{-- box4 --}}
						<h4>Notifications And Announcements</h4>
						@if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))<a href="{{ route('Settings') }}" id="btnshowsales">+ Add New Announcement</a>@endif
                    </div>
                    @if(isset($dataAnnouncements))
                        <div class="todo box" style="max-height: 600px !important; overflow-y: scroll; padding-right: 20px">
                            @foreach ($dataAnnouncements as $announcement)
                                <ul class="todo-list" id="anncontainer">
                                    <li class="completed" style="margin: 5px 0">
                                        <div>
                                            <h4 >Jonel's Water Refilling Station </h4>
                                            <small style="color: grey">{{ $announcement->created_at->diffForHumans() }}</small>
                                            <p style="text-align:justify; margin-top: 4px">{{ $announcement->annoucements_content }}</p>
                                    </div>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    @endif
                </div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
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
	<style>
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
			font-size: 14px
        }
        #btnshowsales:hover{
            background: rgb(84, 164, 238);
        }
	</style>
    <script src="{{ asset('js/numberonly.js') }}"></script>
    <script src="{{ asset('js/textonly.js') }}"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
