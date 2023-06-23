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
	<title>Settings</title>
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
			<li class="active">
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
					<h1>Sales</h1>
					<ul class="breadcrumb">
						<li>
							<a href="dashboard.html">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Settings</a>
						</li>
					</ul>
				</div>

			<div class="table-data">
				@if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                <div class="order">
                    <div class="head">
                        {{-- box1 --}}
						<h4>Personal Information</h4>
                    </div>
					<div class="head">
						<form action="" method="post">
							@csrf
							<label for="">First Name</label><br>
							<input type="text" class="inputs-products"><br>
							<label for="">Last Name</label><br>
							<input type="text" class="inputs-products"><br>
							<label for="">Profile</label><br>
							<input type="file" class="inputs-products">
							<button type="submit" 
							style="
							width: max-content; padding:8px 12px; margin-left:.8rem;
							cursor: pointer; border:none; background-color:#3c94e6;
							border-radius:2px; color:#F9F9F9;
							"
							>Save</button>
						</form>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box2 --}}
						<h4>Product Price</h4>
                    </div>
					<table>
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Product Name</td>
								<td>Price</td>
								<td>
									<li>
										<a href="#" style="color:inherit">
											<h1><i class='bx bxs-edit-alt' ></i></h1>
										</a>
									</li>
								</td>
							</tr>
						</tbody>
					</table>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box3 --}}
						<h4>Set Minimun Product Stock Alert Notification</h4>
                    </div>
					<table>
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Minimun Stocks</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Product Name</td>
								<td>10</td>
								<td>
									<li>
										<a href="#" style="color:inherit">
											<h1><i class='bx bxs-edit-alt' ></i></h1>
										</a>
									</li>
								</td>
							</tr>
						</tbody>
					</table>
                </div>
				@endif
				@if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                <div class="order">
                    <div class="head">
                        {{-- box4 --}}
						<h4>Post Announcement</h4>
                    </div>		
                    <div class="head">
						<form action="" method="post">
							@csrf
							<label for="">Caption</label><br>
							<textarea name="" id="" cols="50" rows="10" class="inputs-products"></textarea>
							<button type="submit" class="save-btn" style="margin-left: 1.2rem">Post</button>
						</form>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box4 --}}
						<h4>Announcement</h4>
                    </div>		
                    <div class="todo box">
						<ul class="todo-list" id="#container">
							<li class="completed " id="req">
								<div>
									<p>
									Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus blanditiis nihil nobis quisquam. Expedita perspiciatis atque magni. Labore sequi neque reprehenderit, vitae laudantium consequatur dolorem blanditiis repellat officia aut aliquid.
									</p>
								</div>
							</li>
							<li class="completed " id="req">
								<div>
									<p>
									Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus blanditiis nihil nobis quisquam. Expedita perspiciatis atque magni. Labore sequi neque reprehenderit, vitae laudantium consequatur dolorem blanditiis repellat officia aut aliquid.
									</p>
								</div>
							</li>
						</ul>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box4 --}}
						<h4>Dark Mode</h4>
                    </div>		
                    <div class="head">
						<nav>
							<div style="width: 100%; display: flex; align-items:center; gap: 10px; justify-content: end">
								<h3>State: </h3>
								<input type="checkbox" id="switch-mode" hidden>
								<label for="switch-mode" class="switch-mode"></label>
							</div>
						</nav>
                    </div>
                </div>
				@endif
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
