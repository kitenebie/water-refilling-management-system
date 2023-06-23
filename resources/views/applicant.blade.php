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

	<title>Applicants</title>
</head>
<body onload="darkmode()">


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="img/header-dashboard.png" alt="" srcset="">
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
            <li  class="active">
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
                <label for="switch-mode" class="switch-mode"></label>
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
					<h1>Applicants</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="#">Applicants</a>
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
						<h3>Recent Orders</h3>
                        <form>
                            <div class="form-input2">
                                <input type="search" name="search" id="search" placeholder="Search Name..." class="recent-search">
                                <button disabled style="cursor:text" type="button" id="btnsearch" class="search-btn"><i tyle="cursor:text" class='bx bx-search' ></i></button>
                            </div>
                        </form>
					</div>
					<table id="tableT">
						<thead>
							<tr>
								<th>Reseller ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>Contact Number</th>
                                <th>Email Address</th>
                                <th></th>
							</tr>
						</thead>
						<tbody>
                            @if (isset($reqData))
                                @foreach ($reqData as $req)
                                    <tr id="existingData">
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ str::mask($req->reseller_id, 'X', 7,5) }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ $req->firstname }} {{ $req->lastname }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ $req->address }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ str::mask($req->contact, 'X', 2,7) }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ str::mask($req->email, 'X', 1,-4) }}</td>
                                        <td style="auto">
                                            <a href="/applicant/Request/Accept/{{ $req->id }}">
                                                <span class="status Completed" style="font-size: .8em; font-weight:600">Accept</span>
                                            </a>
                                            <a href="/applicant/Request/Decline/{{ $req->id }}">
                                                <span class="status Pending" style="font-size: .8em; font-weight:600">Decline</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if (isset($Data))
                            @foreach ($Data as $req)
                                <tr id="existingData">
                                    <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ $req->reseller_id }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ $req->firstname }} {{ $req->lastname }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ $req->address }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ $req->contact }}</td>
                                        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;padding: 1px 2px">{{ $req->email }}</td>
                                        <td style="auto">
                                        <a href="/applicant/Request/Accept/{{ $req->id }}">
                                            <span class="status Completed" style="font-size: .8em; font-weight:600">Accept</span>
                                        </a>
                                        <a href="/applicant/Request/Decline/{{ $req->id }}">
                                            <span class="status Pending" style="font-size: .8em; font-weight:600">Decline</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
						</tbody>
					</table>
				</div>
				{{--  <div class="todo">
					<div class="head" style="position: relative">
						<h3>Applying Reseller <i class='bx bxs-bell' ></i><span id="count" style="color:red; position: absolute; top:0; font-size:.8rem"></span></h3>
					</div>
					<ul class="todo-list" id="#container">
					</ul>
				</div>  --}}
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script>
        $(document).ready(function() {
            var count = $('.relative').length;
            $('#count').text(count);

            var searchInput = $("#search");

            searchInput.on("keyup", function() {
                var searchTerm = this.value;
                var rows = $("#tableT #existingData");
                rows.each(function() {
                var rowText = $(this).text();

                if (rowText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
                });
            });
        });
    </script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
