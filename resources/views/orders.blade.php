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

	<title>Orders & Transactions</title>
</head>
<body onload="darkmode()">


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="img/header-dashboard.png" alt="" srcset="">
			<span class="text">Order & Transaction</span>
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
			    <li  class="active">
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
            <li  class="active">
                <a href="{{ route('orders') }}">
                    <i class='bx bxs-cart' ></i>
                    <span class="text">Request Order</span>
                </a>
            </li>
            <li>
                <a href="{{ route('refillrequest') }}">
                    <i class='bx bxs-store-alt' ></i>
                    <span class="text">Refill Transaction</span>
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
					<h1>Orders and Transactions</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active order_btn" href="{{ route('orders') }}"><strong>Orders</strong></a>
						</li>
						<li>
							<a class="active order_btn" href="{{ route('Request') }}">Request</a>
						</li>
						<li>
							<a class="active order_btn" href="{{ route('ToReceive') }}">ToReceive</a>
						</li>
						<li>
							<a class="active order_btn" href="{{ route('Completed') }}">Completed</a>
						</li>
						<li>
							<a class="active order_btn" href="{{ route('cancelled') }}">Cancelled</a>
						</li>
					</ul>
				</div>
				{{--  <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>  --}}
			</div>

			<div class="table-data">
                @if (isset($label_title))
				<div class="order">
					<div class="head">
                        <h2>{{ $label_title }}</h2>
                        @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                            @if($label_title == "To Receive Orders")
                            <li>
                                <button class="save-btn status Pending" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-wigth:700">
                                    <i class='bx bxs-download' ></i>
                                    <span class="text">Export Process Report</span>
                                </button>
                            </li>
                            @endif

                            @if($label_title == "Completed Orders")
                            <li>
                                <button class="save-btn" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-wigth:700">
                                    <i class='bx bxs-download' ></i>
                                    <span class="text">Export Completed Report</span>
                                </button>
                            </li>
                            @endif
                        @endif


                    </div>
                    <div class="table-data">
                        <table>
                            <thead>
                                <tr>
                                    <th>Seller ID</th>
                                    <th>Seller Name</th>
                                    <th>No. of Orders</th>
                                    <th>Product Order ID</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($resellerReqData) && isset($N3wData))
                                @php
                                $count = 0;
                                @endphp
                                    @foreach($resellerReqData as $resellerData)
                                    <form action="{{ route('CompleteAddSale') }}" method="get">
                                        @csrf
                                    <tr>
                                        @php
                                        $data = json_decode($N3wData[$count], true);
                                        $Name = $data[0]['lastname']. ", ".$data[0]['firstname'];
                                        @endphp
                                            <td>
                                                <input type="text" hidden name="orderid" value=" {{ $resellerData->id }}">
                                                {{ str::mask($resellerData->reseller_ID, 'X', 7,5) }}
                                                <input type="text" hidden name="resellerID" value=" {{ $resellerData->reseller_ID }}">
                                            </td>
                                            <td>
                                                {{ $Name }}
                                                <input type="text" hidden name="Name" value=" {{ $Name }}">
                                            </td>
                                            <td>
                                                {{ $resellerData->order }}
                                                <input type="text" hidden name="order" value="{{ $resellerData->order }}">
                                            </td>
                                            <td>
                                                <a style="text-decoration: none; color:inherit" href="/orders/Request/{{ $resellerData->product_ID }}">
                                                    {{ $resellerData->product_ID }}
                                                    <input type="text" hidden name="product_ID" value="{{ $resellerData->product_ID }}">
                                                </a>
                                            </td>
                                            <td>
                                                PHP {{ number_format($resellerData->Amount, 2) }}
                                                <input type="text" hidden name="Amount" value="{{ $resellerData->Amount }}">
                                            </td>
                                            <td>{{ $resellerData->created_at = date("M-d-Y") }}</td>
                                            <td>
                                                @if ($label_title == "Request Orders")
                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                                    <a href="/orders/Request/Accept/{{ $resellerData->id }}/quantity/{{ $resellerData->order }}/productID/{{ $resellerData->product_ID }}">
                                                    <span class="status Completed" style="font-size: .8em; font-weight:600">Accept</span>
                                                    </a>
                                                    <a href="/orders/Request/Decline/{{ $resellerData->id }}">
                                                        <span class="status Cancelled" style="font-size: .8em; font-weight:600">Decline</span>
                                                    </a>
                                                    @endif

                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                                                        <a href="/orders/Request/Decline/{{ $resellerData->id }}">
                                                            <span class="status Cancelled" style="font-size: .8em; font-weight:600">Cancel Order</span>
                                                        </a>
                                                    @endif
                                                @endif

                                                @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                                    @if ($label_title == "To Receive Orders")
                                                        <button type="submit" style="border:none; background:transparent; cursor:pointer">
                                                            <span class="status Completed" style="font-size: .8em; font-weight:600">Complete</span>
                                                        </button>
                                                    @endif
                                                    @if ($label_title == "Cancelled Orders")
                                                        <a href="/orders/Request/Received/{{ $resellerData->id }}">
                                                            <span class="status Pending" style="font-size: .8em; font-weight:600">Delete</span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        @php
                                            $count++;
                                        @endphp
                                        @endforeach
                                        </tr>
                                    </form>
                                </a>
                                @endif
                            </tbody>
                        </table>
                    </div>
				</div>
                @endif
			</div>
            @if (!isset($label_title))
			<div class="table-data">
				<div class="order" style="display: flex; flex-direction:column">
                            <h1>Refill and Purchase Request</h1><br>
                        
 
                           <form style="display: flex; flex-direction:column; width:100%;">
                                <label  class="input_margin" for="">Select Category</label>
                                <select style="font-weight:700" id="category" class="inputs-products">
                                    <option value="0">Refill</option>
                                    <option selected value="1">Purchase</option>
                                </select>
                            </form>       
                            <form id="PurchaseRequest" style="display: flex; flex-direction:column" 
                            @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                                action="{{ route('SubmitProductRequest') }}"
                            @endif
                            @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                action="{{ route('AddProductSales') }}"
                            @endif
                            method="post">
                                @csrf
                                <input hidden type="text" name="product_ID" id="product_ID">
                                <label id="labelCahange" class="input_margin" for=""><span style="color:rgb(238, 23, 7); font-weight: 700">*</span> Select Product</label>
                                <select readonly name="productname" id="productname" class="inputs-products">
                                </select>
                               <label class="input_margin" for=""><span style="color:rgb(238, 23, 7); font-weight: 700">*</span>Quantity</label>
                                <input type="text" name="order" id="prdqty" class="inputs-products" placeholder="e.g., 10"/>
                                <label id="costlbl" class="input_margin" for="">Cost (Php)</label>
                                <input readonly type="text" name="" id="prdcost" class="inputs-products" placeholder=""/>
                                @if (session()->get('auth') == 'Reseller')
                                <label id="labelpymnt" class="input_margin" for="">Select Payment Method</label>
                                <select name="" id="pymnt" class="inputs-products">
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    {{--  <option value="Walk in">Walk in</option>  --}}
                                </select>
                                <label id="sfeelbl" class="input_margin" for="">Shipping Fee (Php)</label>
                                <input type="text" value="5" name="" id="prdfee" class="inputs-products" placeholder="e.g., 10"/>
                                @endif

                                <label class="input_margin" for="">Total Cost (Php)</label>
                                <input style="font-weight: 700" type="text" readonly name="price" id="prdtotal" class="inputs-products"/>

                                <br>
                                <div style="width:100%;">
                                    <button id="reset" type="button" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                    <button type="submit" class="save-btn"><i class='bx bx-save' ></i> Submit</button>
                                </div>
                            </form>       
                            <form id="RefillRequest" style="display: flex; flex-direction:column" 
                                @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                                    action="{{ route('SubmitRefillRequest') }}"
                                @endif
                                @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                    action="{{ route('AddRefillSalesAdmin') }}"
                                @endif
                            
                                method="post">
                                @csrf
                                <label id="labelCahange" class="input_margin" for=""><span style="color:rgb(238, 23, 7); font-weight: 700">*</span> Number of Gallon</label>
                                <input type="text" name="numberGalllon" id="numberGalllon" placeholder="e.g., 10" class="inputs-products"/>
                                <label id="costlbl" class="input_margin" for="">Cost (Php)</label>
                                <input type="text" name="refillcost" id="refillcost" class="inputs-products" placeholder=""/>
                                <label id="refillshipfee" class="input_margin" for="">Shipping Fee (Php)</label>
                                <input type="text" value="5" name="refillfee" id="refillfee" class="inputs-products" placeholder="e.g., 10"/>
                                <label class="input_margin" for="">Total Cost (Php)</label>
                                <input style="font-weight: 700" type="text" readonly name="refilltotal" id="refilltotal" class="inputs-products"/>

                                <br>
                                <div style="width:100%;">
                                    <button id="reset" type="button" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                    <button type="submit" class="save-btn"><i class='bx bx-save' ></i> Submit</button>
                                </div>
                            </form>
				        </div>
                <div class="order">
                    <h1>Present Items</h1><br>
                    <div class="head">
                        <form action="{{ route('searchPresentProduct') }}" method="post">
                            @csrf
                            <div class="form-input2">
                                <input name="search" type="search" placeholder="Search..." class="recent-search" style="font-size: 1rem"/>
                                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                            </div>
                        </form>
                    </div>
					<div class="head">
                        <table id="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity Stocks</th>
                                    <th>Price</th>
                                    <th hidden>product_ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($productData))
                                @foreach ($productData as $product)
                                <tr>

                                        <td style="margin:0;padding:0;color: #3c94e6; cursor: pointer">
                                            {{ $product->product_Name }}</td>
                                        <td>{{ $product->stocks }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td hidden>{{ $product->product_id }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
            @endif
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <!-- Scripts -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>

    @if (session('success'))
    <input hidden type="text" value="{{ session('success') }}" id="welcomeMSG">
    <script>
        toastr.success($('#welcomeMSG').val(), "Account Order", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
    {{-- refilled --}}
    @if (session('refilled'))
    <script>
        toastr.success("Refill Completed", "Request Submitted!", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
    @if (session('clientrefilled'))
    <script>
        toastr.success("Refill request has been submitted", "Request Submitted!", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
	<script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_JQUERY_LINK') }}"></script>
    
    <script src="{{ asset('js/resellerorders.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
    <script src="{{ asset('js/adminorders.js') }}"></script>

</body>
</html>
