@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="{{ env('JQUERY_AJAX_URL') }}"></script>
	<title>Orders & Transactions</title>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
			    <li class="active">
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

        @php
        $count = 0;
        @endphp

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Orders and Transactions</h1>
					<ul class="breadcrumb">
                        @if(isset($label_title))
						<li>
							<a class="active order_btn"  href="{{ route('orders') }}"><strong>Orders</strong></a>
						</li>
                        <li>
                            <a class="active order_btn @if($label_title == "Request Orders") activebtn @endif"  href="{{ route('Request') }}">Request</a>
                        </li>
                        <li>
                            <a class="active order_btn @if($label_title == "To Receive Orders") activebtn @endif"  href="{{ route('ToReceive') }}">ToReceive</a>
                        </li>
                        <li>
                            <a class="active order_btn @if($label_title == "Completed Orders") activebtn @endif"  href="{{ route('Completed') }}">Completed</a>
                        </li>
                        <li>
                            <a class="active order_btn @if($label_title == "Cancelled Orders") activebtn @endif"  href="{{ route('cancelled') }}">Cancelled</a>
                        </li>
                        @else
						<li>
							<a class="active order_btn activebtn"  href="{{ route('orders') }}"><strong>Orders</strong></a>
						</li>
                        <li>
                            <a class="active order_btn" href="{{ route('Request') }}">Request</a>
                        </li>
                        <li>
                            <a class="active order_btn"  href="{{ route('ToReceive') }}">ToReceive</a>
                        </li>
                        <li>
                            <a class="active order_btn"  href="{{ route('Completed') }}">Completed</a>
                        </li>
                        <li>
                            <a class="active order_btn"  href="{{ route('cancelled') }}">Cancelled</a>
                        </li>
                        @endif
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
                                <a href="{{ route('get_toReceive_orders') }}" class="save-btn status Pending" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-weight:700">
                                    <i class='bx bxs-download' ></i>
                                    <span class="text"> Process Report</span>
                                </a>
                            </li>
                            @endif

                            @if($label_title == "Completed Orders")
                            <li>
                                <a  href="{{ route('get_completed_orders') }}" class="save-btn" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-weight:700">
                                    <i class='bx bxs-download' ></i>
                                    <span class="text"> Completed Report {{ date('F-Y') }}</span>
                                </a>
                            </li>
                            @endif
                        @endif


                    </div>
                    <div class="table-data">
                        <table>
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th>Seller Name</th>
                                    <th>No. of Orders</th>
                                    <th>Product Name</th>
                                    <th>Total Amount</th>
                                    <th>Payment Method</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--  {{ dd($N3wData) }}  --}}
                                @if($resellerReqData)
                                    @foreach($resellerReqData as $resellerData)
                                    <?php
                                    $data = json_decode($N3wData[$count], true);
                                    $Name = $data[0]['lastname']. ", ".$data[0]['firstname'];
                                    ?>
                                    <tr>
                                            <td style="display: none">
                                                {{ $resellerData->orderID }}
                                            </td>
                                            <td style="display: none">
                                                {{ $resellerData->price }}
                                            </td>
                                            <td>
                                                <input type="text" hidden name="resellerID" value=" {{ $resellerData->reseller_ID }}">
                                                <input type="text" hidden name="orderid" id="currentID" value=" {{ $resellerData->orderID }}">
                                                
                                                {{ $Name }}
                                                <input type="text" hidden name="Name" value=" {{ $Name }}">
                                            </td>
                                            <td>
                                                {{ $resellerData->order }} 
                                                
                                                <input type="text" hidden name="order" value="{{ $resellerData->order }}">
                                            </td>
                                            <td>
                                                <a style="text-decoration: none; color:inherit" href="/orders/Request/{{ $resellerData->product_ID }}">
                                                    {{ $resellerData->product_Name }}
                                                    <input type="text" hidden name="product_ID" value="{{ $resellerData->product_ID }}">
                                                </a>
                                            </td>
                                            <td>
                                                ₱ {{ number_format($resellerData->Amount, 2) }}
                                                <input type="text" hidden name="Amount" value="{{ $resellerData->Amount }}">
                                            </td>
                                             <td>
                                                {{ $resellerData->paymentMethod }}
                                                <input type="text" hidden name="pyment" value="{{ $resellerData->paymentMethod }}">
                                            </td> 
                                            <td>
                                                @if ($label_title == "Request Orders")
                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                                    <a href="/orders/Request/Accept/{{ $resellerData->orderID }}/quantity/{{ $resellerData->order }}/productID/{{ $resellerData->product_ID }}">
                                                    <span class="status Completed" style="font-size: .8em; font-weight:600">Accept</span>
                                                    </a>
                                                    {{-- href="/orders/Request/Decline/{{ $resellerData->orderID }}" --}}
                                                    <a id="openModalcancel" href="#" onclick="cancelData(this)">
                                                        <span class="status Cancelled" style="font-size: .8em; font-weight:600">Decline</span>
                                                    </a>
                                                    @endif

                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                                                    {{-- href="/orders/Request/Decline/{{ $resellerData->orderID }}" --}}
                                                    <a id="openModalcancel" href="#" onclick="cancelData(this)">
                                                            <span class="status Cancelled" style="font-size: .8em; font-weight:600">Cancel</span>
                                                        </a>
                                                        <a id="openModal" onclick="printRowData(this)" class="tooltip inline-block">
                                                            <span class="status Pending" style="font-size: .8em; font-weight:600">Edit</span>
                                                            <span class="tooltiptext">Change Product Quantity</span>
                                                        </a>
                                                    @endif
                                                @endif

                                                @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                                    @if ($label_title == "To Receive Orders")
                                                        <a href="/Complete/{{ $resellerData->orderID }}/pymt/{{ $resellerData->paymentMethod }}" style="border:none; background:transparent; cursor:pointer">
                                                            <span class="status Completed" style="font-size: .8em; font-weight:600">Complete</span>
                                                        </a>
                                                    @endif
                                                    {{-- @if ($label_title == "Cancelled Orders")
                                                       <a href="#">
                                                           <span class="status Completed" style="font-size: .8em; font-weight:600">Restore</span>
                                                       </a>
                                                   @endif  --}}
                                                @endif
                                            </td>
                                            <td>
                                                {{ Illuminate\Support\Carbon::parse($resellerData->theID)->diffForHumans() }}
                                            </td>
                                        @php
                                            $count++;
                                        @endphp
                                        @endforeach
                                        </tr>
                                </a>
                                @endif
                            </tbody>
                        </table>
                    </div>
				</div>
                @endif
			</div>

            <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">            
                <form action="{{ route('update_change') }}" method="post">
                    @csrf
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                  <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                      <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                          <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="fill: rgba(245, 121, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                          </div>
                          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title"></h3>
                            <h3 class="text-base leading-4 text-gray-500" id="modalqty"></h3>
                            <div class="mt-2">
                                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Change product quantity.</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                  <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                  </div>
                                  <input type="hidden" name="orderID" id="orderID">
                                  <input required type="number" name="newQTY" id="newQTY" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                  <input type="hidden" name="thePrice" id="thePrice" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button  type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Save Changes</button>
                        <button id="closeModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
              </div>
              <style>
                input[type="number"]::-webkit-inner-spin-button,
                input[type="number"]::-webkit-outer-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }
                
                .tooltip {
                    position: relative;
                    display: inline-block;
                    cursor:pointer;
                }

                .tooltip .tooltiptext {
                    font-size: 12px !important;
                    visibility: hidden;
                    width: max-content;
                    background-color: #eb820a;
                    color: #fff;
                    text-align: center;
                    border-radius: 6px;
                    padding: 4px 8px;
                    position: absolute;
                    z-index: 1;
                    bottom: 125%;
                    left: 50%;
                    transform: translateX(-50%);
                    opacity: 0;
                    transition: opacity 0.3s;
                }

                .tooltip:hover .tooltiptext {
                    visibility: visible;
                    opacity: 1;
                }
            </style>
            
            <div id="modalcancel" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                  <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                      <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                          <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                          </div>
                          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-8 text-gray-900" id="modal-title"></h3>
                            <div class="mt-2">
                              <p class="text-sm text-gray-500">Are you sure you want to <strong class="text-red-500">Cancel</strong> this product? All of the data will be permanently removed. This action cannot be undone.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button onclick="CancelItem()" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Yes, cancel</button>
                        <button id="closeModalcancel" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">No</button>
                      </div>
                    </div>
                  </div>
                </div>
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
                                <input type="hidden" name="product_ID" id="product_ID">
                                <label id="labelCahange" class="input_margin" for=""><span style="color:rgb(238, 23, 7); font-weight: 700">*</span> Select Product</label>
                                {{--  <select readonly name="productname" id="productname" class="inputs-products">
                                    @if(isset($productData))
                                        @foreach ($productData as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_Name }}</option>
                                        @endforeach
                                    @endif
                                </select>  --}}
                                <label id="productNAME"
                                class="inputs-products" style="height: 40px !important"
                                ></label>
                                <input type="hidden" name="productname" id="productname" class="inputs-products"/>
                                <label class="input_margin" for=""><span style="color:rgb(238, 23, 7); font-weight: 700">*</span>Quantity</label>
                                <input required type="text" name="order" id="prdqty" class="inputs-products" placeholder="e.g., 10"/>
                                <label id="costlbl" class="input_margin" for="">Cost (Php)</label>
                                <input required readonly type="text" name="prdcost" id="prdcost" class="inputs-products" placeholder=""/>
                                @if (session()->get('auth') == 'Reseller')
                                <label id="labelpymnt" class="input_margin" for="">Payment Method</label>
                                <select name="pymnt" id="pymnt" class="inputs-products">
                                    <option selected value="Cash on Delivery">Cash on Delivery</option>
                                     <option value="Walk in">Walk in</option> 
                                </select>
                                <label id="sfeelbl" class="input_margin" for="">Shipping Fee (Php)</label>
                                @if(isset($Fees))
                                    @foreach ($Fees as $fee)
                                    <input required readonly type="text" value="{{ $fee->Fee }}" name="" id="prdfee" class="inputs-products" placeholder="e.g., 10"/>
                                    @endforeach
                                @endif
                                @endif

                                <label class="input_margin" for="">Total Cost (Php)</label>
                                <input required style="font-weight: 700" type="text" hidden  name="price" id="prdtotal1" class="inputs-products"/>
                                <input required style="font-weight: 700" type="text" readonly id="prdtotal" class="inputs-products"/>

                                <br>
                                <div style="width:100%;">
                                    <button id="reset" type="button" class="save-btn clear" style="background:rgb(233, 49, 35)"><i class='bx bx-x' ></i> Clear</button>
                                    <button type="submit" class="save-btn" style="background: #3c94e6"><i class='bx bx-save' ></i> Submit</button>
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
                                {{-- {{ dd(session()->get(env('USER_CURRENT_ADDRESS'))) }} --}}
                                @csrf
                                @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                                <label id="labelpymnt" class="input_margin" for=""><span style="color:rgb(238, 23, 7); font-weight: 700">* </span>Payment Method</label>
                                <select required name="pymnt" id="refillpymnt" class="inputs-products">
                                    <option selected value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="Walk in">Walk in</option> 
                                </select>
                                @endif

                                <label id="labelCahange" class="input_margin" for=""><span style="color:rgb(238, 23, 7); font-weight: 700">*</span> Number of Gallon</label>
                                <input required type="text" name="numberGalllon" id="numberGalllon" placeholder="e.g., 10" class="inputs-products"/>
                                <label id="costlbl" class="input_margin" for="">Cost (Php)</label>
                                <input required type="text" readonly value="@if(isset($getRefillCost)){{ $getRefillCost }}@endif" name="refillcost" id="refillcost" class="inputs-products" placeholder=""/>
                                
                                @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                                <label id="refillshipfee1" class="input_margin" for="">Shipping Fee (Php)</label>
                                @if(isset($Fees))
                                    @foreach ($Fees as $fee)
                                        <input required readonly type="text" value="{{ $fee->RefillFee }}" name="refillfee" id="refillfee" class="inputs-products"/>
                                    @endforeach
                                @endif
                                @endif
                                <label class="input_margin" for="">Total Cost (Php)</label>
                                <input required style="font-weight: 700" type="text" readonly name="refilltotal" id="refilltotal" class="inputs-products"/>
                                <input hidden required style="font-weight: 700" type="text" readonly name="refilltotal" id="refilltotal1" class="inputs-products"/>

                                <br>
                                <div style="width:100%;">
                                    <button id="reset" type="button" class="save-btn clear" style="background:rgb(233, 49, 35)"><i class='bx bx-x' ></i> Clear</button>
                                    <button type="submit" class="save-btn" style="background: #3c94e6"><i class='bx bx-save' ></i> Submit</button>
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
                                        <td>{{ number_format($product->stocks) }}</td>
                                        <td>₱{{ number_format($product->price, 2) }}</td>
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
    <script src="{{ asset('js/numberonly.js') }}"></script>
    <script src="{{ asset('js/textonly.js') }}"></script>
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>

    <!-- JavaScript to open and close the modal -->

    <script>
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
        
        const closeModalButtoncancel = document.getElementById('closeModalcancel');
        const modalcancel = document.getElementById('modalcancel');
        const openModalButtoncancel = document.querySelectorAll('#openModalcancel');
        openModalButtoncancel.forEach(function(element) {
            element.addEventListener('click', () => {
                modalcancel.classList.remove('hidden');
            });
        });
        closeModalButtoncancel.addEventListener('click', () => {
            modalcancel.classList.add('hidden');
        });
    </script>
    <script>
        const title = document.getElementById('modal-title');
        const modalqty = document.getElementById('modalqty');
        const orderID = document.getElementById('orderID');
        const thePrice = document.getElementById('thePrice');
        var currentPRice;
        function printRowData(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
    
            // Get data from the row cells
            title.innerHTML = row.cells[4].textContent;
            modalqty.innerHTML = 'Current Quantity: ' + row.cells[3].textContent;
            currentPRice = row.cells[1].textContent;
            orderID.value = row.cells[0].textContent;
            thePrice.value = currentPRice;
        }
        
        var url_link;
        function cancelData(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
            // Get data from the row cells
            // title.innerHTML = 'Product: ' + row.cells[1].textContent.toUpperCase();
            url_link = `/orders/Request/Decline/${encodeURIComponent(row.cells[0].textContent)}`;
        }       
        function CancelItem()
        {
           return  window.location.href = url_link;
        }
    </script>
    @if (session('Cancelled'))
    <script>
        toastr.warning("Request has been cancelled", "Order Purchased Cancelled", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
    @if (session('successOrder'))
    <script>
        toastr.success("Successfully Submitted Request", "Order Purchased", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
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
    
    @if (session('updated'))
    <script>
        toastr.success("Request Changed", "Successfully Updated!", {
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
    @if (session('created'))
    <script>
        toastr.success("Successfully Purchased", "Product Added to Sales!", {
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
					var response = data;
                    $('.num').text(response.length);
				}
				});
		});

	</script>
@endif
        <script>
            $(document).ready(function() {
                $("#productname").change(function() {
                var data = $(this).val();
                $.ajax({
                    url: "/productPrices/" + data,
                    success: function(res) {
                        $("#prdcost").val(res);
                    }
                });
                });
            });
        </script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_JQUERY_LINK') }}"></script>

    @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
    <script>
        $('#RefillRequest').hide()
        $('#category').on('change',()=>{
            if($('#category').val()==0){
                $('#PurchaseRequest').hide()
                $('#RefillRequest').show()
            }
            if($('#category').val()==1){
                $('#PurchaseRequest').show()
                $('#RefillRequest').hide()
            }
        });
        $('#numberGalllon').on('input', ()=>{
            ResellerRefilCaculate();
        });
        $('#refillcost').on('input', ()=>{
            ResellerRefilCaculate();
        });
        $('#refillfee').on('input', ()=>{
            ResellerRefilCaculate();
        });
        function ResellerRefilCaculate(){
            const numberGalllon = $('#numberGalllon').val();
            const refillcost = $('#refillcost').val();
            const refillfee = $('#refillfee').val();
            const refilltotal = $('#refilltotal');
            const refilltotal1 = $('#refilltotal1');
            const refilltotalamount = parseInt(numberGalllon)*(parseFloat(refillcost));
            if(refilltotalamount !== refilltotalamount){
                return refilltotal.val(parseFloat(0.00));
            }
            
            const formattedNumber = refilltotalamount.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 3,
            });
            refilltotal1.val(refilltotalamount);
            refilltotal.val(formattedNumber);
        }
        </script>
        
    <script>
        $('#prdqty').on('input', ()=>{
            handleInput();
        });
        
        function handleInput() {
            const prdcost = document.getElementById("prdcost");
            const prdtotal = document.getElementById("prdtotal");
            const prdtotal1 = document.getElementById("prdtotal1");
            const prdqty = document.getElementById("prdqty");
            var total = parseInt(prdqty.value) * parseFloat(prdcost.value)
            const formattedNumber = total.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 3,
            });
            prdtotal.value = formattedNumber;
            prdtotal1.value = total;
            }

    </script>

    @endif
    @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
    <script>
        $('#RefillRequest').hide()
        $('#category').on('change',()=>{
            if($('#category').val()==0){
                $('#PurchaseRequest').hide()
                $('#RefillRequest').show()
            }
            if($('#category').val()==1){
                $('#PurchaseRequest').show()
                $('#RefillRequest').hide()
            }
        });
        $('#numberGalllon').on('input', ()=>{
            ResellerRefilCaculate();
        });
        $('#refillcost').on('input', ()=>{
            ResellerRefilCaculate();
        });
        $('#refillfee').on('input', ()=>{
            ResellerRefilCaculate();
        });
        $('#refillpymnt').on('change',()=>{
            if($('#refillpymnt').val() === "Cash on Delivery"){
                $('#refillfee').show()
                $('#refillshipfee1').show()
                ResellerRefilCaculate();
            }
            if($('#refillpymnt').val() === "Walk in"){
                $('#refillfee').hide()
                $('#refillshipfee1').hide()
                ResellerRefilCaculate();
            }
        });
        function ResellerRefilCaculate(){
            const refillpymnt = $('#refillpymnt').val();
            const numberGalllon = $('#numberGalllon').val();
            const refillcost = $('#refillcost').val();
            const refillfee = $('#refillfee').val();
            const refilltotal = $('#refilltotal');
            const refilltotal1 = $('#refilltotal1');
            if(numberGalllon >= 10)
            {
                $('#refillfee').hide()
                $('#refillshipfee1').hide()
            }else{
                $('#refillfee').show()
                $('#refillshipfee1').show()
            }
            if(numberGalllon >= 10 || refillpymnt == "Walk in")
            {
                var refilltotalamount = parseInt(numberGalllon)*parseFloat(refillcost);

            }else{
                var refilltotalamount = (parseInt(numberGalllon)+parseFloat(refillfee))*parseFloat(refillcost);
                $('#refillfee').hide()
                $('#refillshipfee1').hide()
            }
    
            if(refilltotalamount !== refilltotalamount){
                return refilltotal.val(parseFloat(0.00));
            }
            const formattedNumber = refilltotalamount.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 3,
            });
            refilltotal1.val(refilltotalamount);
            refilltotal.val(formattedNumber);
        }
        </script>
        
    <script>
        $('#prdqty').on('input', ()=>{
            handleInput();
        });
        $('#pymnt').on('change',()=>{
            if($('#pymnt').val() === "Cash on Delivery"){
                $('#prdfee').show()
                $('#sfeelbl').show()
                handleInput();
            }
            if($('#pymnt').val() === "Walk in"){
                $('#prdfee').hide()
                $('#sfeelbl').hide()
                handleInput();
            }
        });
        function handleInput() {
            const prdcost = document.getElementById("prdcost");
            const prdtotal = document.getElementById("prdtotal");
            const prdtotal1 = document.getElementById("prdtotal1");
            const prdqty = document.getElementById("prdqty");
            const prdfee = document.getElementById("prdfee");
            const sfeelbl = document.getElementById("sfeelbl");
            if(prdqty.value >= 10){
                $('#prdfee').hide()
                $('#sfeelbl').hide()
            }else{
                $('#prdfee').show()
                $('#sfeelbl').show()
            }
            if(prdqty.value >= 10 || $('#pymnt').val() === "Walk in"){
                var total = parseInt(prdqty.value) * parseFloat(prdcost.value)
                $('#prdfee').hide()
                $('#sfeelbl').hide()
            }else{
                var total = (parseInt(prdqty.value) + parseFloat(prdfee.value)) * parseFloat(prdcost.value)
            }
            const formattedNumber = total.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 3,
            });
            prdtotal.value = formattedNumber;
            prdtotal1.value = total;
            }

    </script>
    @endif
    <script>
    $('#table tr').click(function() {
        var productNAme = $(this).find('td:first').text();
        var originalText = $(this).find('td:nth-child(3)').text(); // Get the original text
        var productCost = originalText.substring(1); // Set the modified text back to the element
        var productID = $(this).find('td:last').text();
        $('#prdcost').val(productCost);
        //$('#productname').html('<option selected value="' + productNAme + '">' + productNAme + '</option>');
        $('#productname').val(productNAme);
        $('#productname').hide();
        $('#productNAME').text(productNAme);
        $('#product_ID').val(productID);
    });
    </script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
    <script src="{{ asset('js/adminorders.js') }}"></script>

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
