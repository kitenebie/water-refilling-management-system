
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
	<title>Settings</title>
    <script src="{{ env('JQUERY_AJAX_URL') }}"></script>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="{{ asset('storage/header-dashboard.png') }}" alt="" srcset="">
			<span class="text">Settings</span>
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
					<h1>Settings</h1>
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
					<div class="head" style="position: relative;">
						<form action="{{ route('updateProfile') }}"method="post" enctype="multipart/form-data">
							@csrf
							@if (isset($details))
								@foreach ($details as $details_details)
									<label for="">First Name</label><br>
									<input value="{{ $details_details->firstname }}" id="fname" name="fname" type="text" class="inputs-products"><br>
									<label for="">Last Name</label><br>
									<input value="{{ $details_details->lastname }}" id="lname" name="lname" type="text" class="inputs-products"><br>
								@endforeach
							@endif
							<label for="">Profile</label><br>
							<input name="image" type="file" class="inputs-products">
							<div width="100" style="margin-top: 5px">
							<li>
								<button type="submit" id="editBTN" style="display: block; margin-left:5px; margin-right: 10px;
								padding: 4px 8px; background: #3C91E6; border:none; color:#F9F9F9; cursor: pointer;
								border-radius: 2px;">
									<h1><i class='bx bxs-save' ></i></h1>Save Changes
								</button>
							</li>
							</div>
						</form>
						<img src="{{ asset('storage/'.session()->get('profile')) }}" alt="Image"
						style="position: absolute; left:auto; width:120px; height:120px;
						top:0; display:block; right:20px; border-radius:1px;
						"
						>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box2 --}}
						<h4>Product Price</h4>
                    </div>
					<form action="{{ route('UpdatePrice') }}" method="post">
						@csrf
					<table>
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
							@if (isset($ProductPrice))
								@foreach ($ProductPrice as $ProductPrice_detaile)
								<tr>
									<td>{{ $ProductPrice_detaile->product_Name }}</td>
									<td><input type="text" name="price[]" value="{{ $ProductPrice_detaile->Price }}"
										style="border: .5px solid #333;
										outline:none; padding: 2px 8px; font-size: inherit; margin-left: 10px">
									</td>
									<td hidden>
										<input type="text" name="ID[]" value="{{ $ProductPrice_detaile->id }}">
									</td>
								</tr>
								@endforeach
							@endif
						</tbody>
					</table>
					<div width="100">
					<li >
						<button type="submit" id="editBTN" style="display: block; margin-left:auto; margin-right: 10px;
						padding: 4px 8px; background: #3C91E6; border:none; color:#F9F9F9; cursor: pointer;
						border-radius: 2px;">
							<h1><i class='bx bxs-save' ></i></h1>Save Changes
						</button>
					</li>
					</div>
				</form>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box3 --}}
						<h4>Set Minimun Product Stock Alert Notification</h4>
                    </div>
					<form action="{{ route('updateLimitStocks') }}" method="post">
						@csrf
					<table>
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Minimun Stocks</th>
							</tr>
						</thead>
						<tbody>
							@if (isset($StockDetails))
								@foreach ($StockDetails as $StockDetail)
									<tr>
										<td>{{ $StockDetail->product_Name }}</td>
										<td>
											<input type="text" name="prdt_limit[]" value="{{ $StockDetail->prdt_limit }}"
										style="border: .5px solid #333;
										outline:none; padding: 2px 8px; font-size: inherit; margin-left: 10px">
										</td>
										<td hidden>
											<input type="text" name="myID[]" value="{{ $StockDetail->id }}">
										</td>
									</tr>
								@endforeach								
							@endif
						</tbody>
					</table>
					<div width="100">
					<li >
						<button type="submit" id="editBTN" style="display: block; margin-left:auto; margin-right: 30px;
						padding: 4px 8px; background: #3C91E6; border:none; color:#F9F9F9; cursor: pointer;
						border-radius: 2px;">
							<h1><i class='bx bxs-save' ></i></h1>Save Changes
						</button>
					</li>
					</div>
				</form>
                </div>
				@endif
				@if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                <div class="order">
                    <div class="head">
                        {{-- box4 --}}
						<h4>Post Announcement</h4>
                    </div>		
                    <div class="head">
						<form action="{{ route('Announcement_Post') }}" method="post">
							@csrf
							<label for="">Caption</label><br>
							<textarea name="annoucements_content" id="annoucements_content" cols="50" rows="10" class="inputs-products"></textarea>
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
						<ul class="todo-list" id="anncontainer">
						</ul>
                    </div>
                </div>
                <div hidden class="order">
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
	{{-- imgsuccess --}}
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>
    <script src="{{ env('TOASTR_JQUERY_LINK') }}"></script>
	@if (session('imgsuccess'))
	<script>
		toastr.success('Successfully Saved!', "Changed", {
			closeButton: true,
			tapToDismiss: true, // prevent the toast from disappearing when clicked
			newestOnTop: true,
			positionClass: 'toast-top-right', // set the position of the toast
			preventDuplicates: true,
		}, 5000);
	</script>
	@endif
	@if (session('posted'))
	<script>
		toastr.info('Successfully Posted!', "Announcement Posted", {
			closeButton: true,
			tapToDismiss: true, // prevent the toast from disappearing when clicked
			newestOnTop: true,
			positionClass: 'toast-top-right', // set the position of the toast
			preventDuplicates: true,
		}, 5000);
	</script>
	@endif
	@if (session('removePost'))
	<script>
		toastr.warning('Successfully Removed!', "Announcement Removed", {
			closeButton: true,
			tapToDismiss: true, // prevent the toast from disappearing when clicked
			newestOnTop: true,
			positionClass: 'toast-top-right', // set the position of the toast
			preventDuplicates: true,
		}, 5000);
	</script>
	@endif
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
					for(var i = 0; i < response.length; i++){
						// console.log(response[i].announce_Code);
						$('#anncontainer').append('<li class="completed"><div><strong><span> '+response[i].created_at.slice(0,10)+' </span></strong><p style="text-align:justify">'+response[i].annoucements_content+'</p> <hr><a href="/remove-announcement/'+response[i].announce_Code+'">remove</a></div></li>')
					}
				}
				});
		})
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
</body>
</html>
