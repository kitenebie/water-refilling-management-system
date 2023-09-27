
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
    <script src="https://cdn.tailwindcss.com"></script>
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
				<li>
					<a href="{{ route('ShowPostNotification') }}">
						<i class='bx bxs-bell'></i>
						<span class="text">Notification</span>
					</a>
				</li>
				<li class="active">
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
						<h4  class="font-bold">Personal Information</h4>
                    </div>
					<div class="head" style="position: relative;">
						<form action="{{ route('updateProfile') }}"method="post" enctype="multipart/form-data">
							@csrf
							@if (isset($details))
								@foreach ($details as $details_details)
									<label for="">First Name</label><br>
									<input value="{{ $details_details->firstname }}" id="userPname" name="fname" type="text" class="inputs-products"><br>
									<label for="">Last Name</label><br>
									<input value="{{ $details_details->lastname }}" id="userPname" name="lname" type="text" class="inputs-products"><br>
								@endforeach
							@endif
							<div width="300" style="margin-top: 8px">
							<li>
								<button type="submit" id="editBTN" style="display: block; margin-left:5px; margin-right: 10px;
								padding: 4px 8px; background: #3C91E6; border:none; color:#F9F9F9; cursor: pointer;
								border-radius: 2px;">
									<h1><i class='bx bxs-save' ></i></h1>Save Changes
								</button>
							</li>
							</div>
						</form>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box2 --}}
						<h4  class="font-bold">Product Price</h4>
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
									<td><input id="priceNum" class="inputs-products1" type="text" name="price[]" value="{{ $ProductPrice_detaile->Price }}">
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
						<h4  class="font-bold">Set Minimun Product Stock Alert Notification</h4>
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
							@if (isset($StockDetails['Name']) && isset($StockDetails['limit']))
                                @for($countPrdct = 0; $countPrdct < count($StockDetails['Name']); $countPrdct++)
									<tr>
										<td>{{ $StockDetails['Name'][$countPrdct] }}</td>
										<td>
											<input id="minstock" class="inputs-products1" type="text" name="prdt_limit[]" value="{{ $StockDetails['limit'][$countPrdct] }}">
										</td>
										<td hidden>
											<input type="text" name="myID[]" value="{{ $StockDetails['P_ID'][$countPrdct] }}"/>
										</td>
									</tr>
								@endfor
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
						<h4  class="font-bold">Post Announcement</h4>
                    </div>
                    <div class="head">
						<form action="{{ route('Announcement_Post') }}" method="post">
							@csrf
							<label for="">Caption</label><br>
							<textarea name="annoucements_content" id="annoucements_content" style="width:450px; height: 350px" class="inputs-products"></textarea>
							<button type="submit" class="save-btn bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm" style="margin-left: 1rem ">Post</button>
						</form>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        {{-- box4 --}}
						<h4  class="font-bold">Announcement</h4>
                    </div>
                    <div class="todo box">
						<ul class="todo-list" id="anncontainer">
						</ul>
                    </div>
                </div>
                <div class="order">
                    <div class="head">
                        <h4  class="font-bold">Refill Cost</h4><br>
                        <form action="{{ route('RefillCost') }}" method="POST" style="width:300px">
                            @csrf
                            <div style="display: flex; flex-direction:column; gap: 2px; width:100%; position: relative;">
                                <label for="">Reffilling Cost: </label>
                                <input style="width: 100%" id="fee" class="inputs-products2" type="text" name="refillCost" value="@if(isset($getRefillCost)){{ $getRefillCost }}@endif">
                                <button style="margin-left: auto; margin-top:3px" type="submit" class="save-btn bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm" style="margin-left: 5.2rem">Save</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="head">
                        <br>
						<h4  class="font-bold">Shipping Fee</h4>
                    </div>
                    <div class="head">
                        <form action="{{ route('saveAddressFee') }}" method="post">
                            @csrf
                            <div>
                                <label for="">Address: </label><br>
                                <input id="address" class="inputs-products2" type="text" name="address" value=""><br><br>
                                <label for="">Product Ship Fee: </label>
                                <input id="fee" class="inputs-products2" type="text" name="fee" value=""><br><br>
                                <label for="">Refill Ship Fee: </label>
                                <input id="fee" class="inputs-products2" type="text" name="Refillfee" value=""><br><br>
                                <button type="submit" class="save-btn bg-blue-500 px-3 py-2 text-sm font-semibold text-white shadow-sm" style="margin-left: 5.2rem">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="head">
                        <table>
                            <thead>
                                <tr>
								<th hidden>id</th>
                                <th>Address</th>
                                <th>Product Ship Fee</th>
                                <th>Refill Ship Fee</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($AddressFees))
                                    @foreach ($AddressFees as $AddressFee)
                                    <tr>
                                        <td style="display: none">{{ $AddressFee->id }}</td>
                                        <td>{{ $AddressFee->Address }}</td>
                                        <td>{{ $AddressFee->Fee }}</td>
                                        <td>{{ $AddressFee->RefillFee }}</td>
                                        <td>
                                            {{--  <a href="/Address-Edit/{{ $AddressFee->id }}">
                                            <span class="status Completed" style="font-size: .8em; font-weight:600">Edit</span>
                                            </a>  --}}
											{{-- /Address-Delete/{{ $AddressFee->id }} --}}
                                            <a onclick="deleteData(this)" id="openModal" href="#">
                                                <span class="status Cancelled" style="font-size: .8em; font-weight:600">Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
					<hr>
					<br>
					<h4  class="font-bold">Temporarily Removing</h4>
					<br>
					<h6 class="font-bold text-gray-500">Deleted Product</h6>
					<div class="head">
						<table>
							<thead>
								<tr>
									<th hidden></th>
									<th>discription</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if (isset($getproductLogs))
									@foreach ($getproductLogs as $getproductLog)
									<tr>
										<td style="display: none">{{ $getproductLog->id }}</td>
										<td>
											Product Deleted <b>{{ $getproductLog->product_Name }}</b>, stocks: {{ $getproductLog->stocks }} and price: {{ number_format($getproductLog->price,2) }}
										</td>
										<td>
											<a onclick="restoreProduct(this)" id="openModal" href="#">
												<span class="status Completed" style="font-size: .8em; font-weight:600">Restore</span>
											</a>
										</td>
									</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<br>
					<h6 class="font-bold text-gray-500">Deleted Address</h6>
					<div class="head">
						<table>
							<thead>
								<tr>
									<th hidden></th>
									<th>discription</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if ($getaddrLogs)
									@foreach ($getaddrLogs as $getaddrLog)
									<tr>
										<td style="display: none">{{ $getaddrLog->id }}</td>
										<td>
											Address Deleted <b>{{ $getaddrLog->Address }}</b>, product shipping fee: {{ number_format($getaddrLog->Fee,2) }} and refill shipping fee: {{ number_format($getaddrLog->RefillFee,2) }}
										</td>
										<td>
											<a onclick="restoreAddress(this)" id="openModal" href="#">
												<span class="status Completed" style="font-size: .8em; font-weight:600">Restore</span>
											</a>
										</td>
									</tr>
										
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
                </div>
				@endif

			</div>
		</main>
		<!-- MAIN -->
	</section>
	
    <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                  </div>
                  <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h5 class="text-base leading-4 text-gray-400" id="modal-title"></h5>
                    <div class="mt-2">
                      <p id="msgContent" class="text-sm text-gray-500"></p>
                      <input type="text" id="itemID">
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button id="yesbtn" onclick="delteItem()" class="inline-flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm sm:ml-3 sm:w-auto"></button>
                <button id="closeModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <script>
        const title = document.getElementById('modal-title');
        const content = document.getElementById('msgContent');
        const yesbtn = document.getElementById('yesbtn');
        var url_link;
        function restoreProduct(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
            // Get data from the row cells
            title.innerHTML = 'Log: ' + row.cells[1].textContent;
			content.innerHTML = 'Are you sure you want to <strong class="text-blue-500">Restore</strong> this product?';
            url_link = `/restore-product/${encodeURIComponent(row.cells[0].textContent)}`;
			yesbtn.classList.add('bg-blue-600');
			yesbtn.classList.add('hover:bg-blue-600');
			yesbtn.classList.remove('bg-red-600');
			yesbtn.classList.remove('hover:bg-red-600');
			yesbtn.innerHTML = "Restore";
        }
        
        function restoreAddress(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
            // Get data from the row cells
            title.innerHTML = 'Log: ' + row.cells[1].textContent;
			content.innerHTML = 'Are you sure you want to <strong class="text-blue-500">Restore</strong> this product?';
            url_link = `/restore-address/${encodeURIComponent(row.cells[0].textContent)}`;
			yesbtn.classList.add('bg-blue-600');
			yesbtn.classList.add('hover:bg-blue-600');
			yesbtn.classList.remove('bg-red-600');
			yesbtn.classList.remove('hover:bg-red-600');
			yesbtn.innerHTML = "Restore";
        }
        function deleteData(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
            // Get data from the row cells
            content.innerHTML = 'Are you sure you want to <strong class="text-red-500">Delete</strong> this product?';
            url_link = `/Address-Delete/${encodeURIComponent(row.cells[0].textContent)}`;
			yesbtn.classList.remove('bg-blue-600');
			yesbtn.classList.remove('hover:bg-blue-600');
			yesbtn.classList.add('bg-red-600');
			yesbtn.classList.add('hover:bg-red-600');
			yesbtn.innerHTML = "Delete";
        }
        function delteItem()
        {
           return  window.location.href = url_link;
        }
        const closeModalButton = document.getElementById('closeModal');
        const modal = document.getElementById('modal');
        const openModalButton = document.querySelectorAll('#openModal');
        openModalButton.forEach(function(element) {
            element.addEventListener('click', () => {
                    modal.classList.remove('hidden');
            });
        });
        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
	<!-- CONTENT -->
    <script src="{{ asset('js/numberonly.js') }}"></script>
    <script src="{{ asset('js/textonly.js') }}"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
	{{-- imgsuccess --}}
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>
    <script src="{{ env('TOASTR_JQUERY_LINK') }}"></script>

	@if (session('restore'))
	<script>
		toastr.info('Successfully Restored', "Data has been Restored!", {
			closeButton: true,
			tapToDismiss: true, // prevent the toast from disappearing when clicked
			newestOnTop: true,
			positionClass: 'toast-top-right', // set the position of the toast
			preventDuplicates: true,
		}, 3000);
	</script>
	@endif

	@if (session('Deleted'))
	<script>
		toastr.warning('Successfully Deleted!', "Adddress has been Deleted!", {
			closeButton: true,
			tapToDismiss: true, // prevent the toast from disappearing when clicked
			newestOnTop: true,
			positionClass: 'toast-top-right', // set the position of the toast
			preventDuplicates: true,
		}, 5000);
	</script>
	@endif
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
	@if (session('existed'))
	<script>
		toastr.warning('Already Registerd!', "Address already existed", {
			closeButton: true,
			tapToDismiss: true, // prevent the toast from disappearing when clicked
			newestOnTop: true,
			positionClass: 'toast-top-right', // set the position of the toast
			preventDuplicates: true,
		}, 5000);
	</script>
	@endif
	@if (session('success'))
	<script>
		toastr.info('Succesfully Registerd!', "New Address Registered", {
			closeButton: true,
			tapToDismiss: true, // prevent the toast from disappearing when clicked
			newestOnTop: true,
			positionClass: 'toast-top-right', // set the position of the toast
			preventDuplicates: true,
		}, 5000);
	</script>
	@endif
	@if (session('UpdateCost'))
	<script>
		toastr.info('Succesfully Updated!', "Refill cost has been changed", {
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
                type: "GET",
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
</body>
</html>
