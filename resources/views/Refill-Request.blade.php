@php
	use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;
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
    <script src="https://cdn.tailwindcss.com"></script>
	<title>Refill Request</title>
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
			    <li class="active">
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
					<h1>Refill Transactions</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active order_btn" @if ($label_title == "Pending Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refillrequest') }}">Request</a>
						</li>
						<li>
							<a class="active order_btn" @if ($label_title == "Process Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refilltoreceive') }}">ToReceive</a>
						</li>
						<li>
							<a class="active order_btn" @if ($label_title == "Completed Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refilltocompleted') }}">Completed</a>
						</li>
						<li>
							<a class="active order_btn" @if ($label_title == "Cancelled Refill Request") style="background-color: rgba(54, 162, 235) !important; color: white !important" @endif href="{{ route('refilltocancelled') }}">Cancelled</a>
						</li>
					</ul>
				</div>
				{{--  <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>  --}}
			@if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
				@if ($label_title == "Process Refill Request")
				<li>
					<a  href="{{ route('get_toReceive_refill') }}" class="save-btn" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-wigth:700">
						<i class='bx bxs-download' ></i>
						<span class="text"> Process Report</span>
					</a>
				</li>
				@endif

				@if ($label_title == "Completed Refill Request")
				<li>
					<a  href="{{ route('get_complete_refill') }}" class="save-btn" style="width: max-content; letter-spacing:.1rem;font-size:1rem; font-wigth:700">
						<i class='bx bxs-download' ></i>
						<span class="text"> Complete Report {{ date('F-Y') }}</span>
					</a>
				</li>
				@endif
			@endif
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
                       @if(isset($label_title))
						<h1>{{ $label_title }}</h1>
						@endif
                    </div>
                    <div class="table-data">
                        <table>
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>Seller Name</th>
                                    <th>No. of Gallon</th>
                                    <th>Total Amount</th>
									<th>Payment Method</th>
                                    <th>Action</th>
                                    <th></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                </tr>
                            </thead>

                            <tbody>
								{{-- {{ dd($statusRefill) }} --}}
                                   @if (isset($statusRefill))
									   @foreach ($statusRefill as $refillStatus)
										   <tr>
												<td style="display: none">
													{{ $refillStatus->id }}
													<input value="{{ $refillStatus->id }}" type="text" name="id" id="id" hidden>
												</td>
												<td>{{ $refillStatus->lastname }}, {{ $refillStatus->firstname }}</td>
												<td>
													{{ $refillStatus->NumberOfGallon }}
													<input value="{{ $refillStatus->NumberOfGallon }}" type="text" name="Quantity" id="Quantity" hidden>
												</td>
												<td>
													₱{{ number_format($refillStatus->TotalCost, 2) }}
													<input value="{{ $refillStatus->TotalCost }}" type="text" name="Amount" id="Amount" hidden>
												</td>
												
												<td>{{ $refillStatus->paymentMethod }}</td> 
												<td>
													@if ($label_title == "Pending Refill Request")
                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                                    <a href="/Refill-request/Request/Accept/{{ $refillStatus->id }}">
                                                    <span class="status Completed" style="font-size: .8em; font-weight:600">Accept</span>
                                                    </a>
													{{-- /Refill-request/Request/Decline/{{ $refillStatus->id }} --}}
                                                    <a id="openModalcancel" onclick="cancelData(this)" href="#">
                                                        <span class="status Cancelled" style="font-size: .8em; font-weight:600">Decline</span>
                                                    </a>
                                                    @endif

                                                    @if(session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
														<a id="openModalcancel" onclick="cancelData(this)" href="#">
															<span class="status Cancelled" style="font-size: .8em; font-weight:600">Cancel Order</span>
														</a>
														<a id="openModal" onclick="printRowData(this)" href="#">
															<span class="status Pending" style="font-size: .8em; font-weight:600">Edit Quantity</span>
														</a>
                                                    @endif
                                                @endif

												@if ($label_title == "Process Refill Request")
													@if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
													<a href="/Refill-request/Request/complete/{{ $refillStatus->id }}/{{ $refillStatus->NumberOfGallon }}/{{ $refillStatus->TotalCost }}/{{ $refillStatus->paymentMethod }}" style="border:none; background:transparent; cursor:pointer">
														<span class="status Completed" style="font-size: .8em; font-weight:600">Complete</span>
													</a>
													@endif
												@endif
                                                    
                                                {{-- @if ($label_title == "Cancelled Refill Request")
													@if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                                        <a href="#">
                                                            <span class="status Completed" style="font-size: .8em; font-weight:600">Restore</span>
                                                        </a>
													@endif
                                                @endif  --}}
												</td>
												<td>
												{{ Carbon::parse($refillStatus->updated_at)->diffForHumans() }}

												</td>
												<td style="display: none">{{ $refillStatus->RefillCost }}</td>
												<td style="display: none">{{ $refillStatus->RefillShipFee }}</td>
										   </tr>
									   @endforeach
								   @endif
                            </tbody>
                        </table>

                    </div>
				</div>
			</div>

			<div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">            
                <form action="{{ route('update_changeRefill') }}" method="post">
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
                                  <input type="hidden" name="shifee" id="shifee" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                  <input type="hidden" name="refill_cost" id="refillcost" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                  <input type="hidden" name="pymentMeth" id="pymentMeth" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                
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
							<h3 class="text-base font-semibold leading-8 text-gray-900" id="pymtmm"></h3>
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
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <!-- Scripts -->
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

        const title = document.getElementById('modal-title');
        const modalqty = document.getElementById('modalqty');
        const orderID = document.getElementById('orderID');
        const shifee = document.getElementById('shifee');
        const refillcost = document.getElementById('refillcost');
        const pymentMeth = document.getElementById('pymentMeth');
        function printRowData(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
    
            // Get data from the row cells
            title.innerHTML = 'Payment Method: ' + row.cells[4].textContent.toUpperCase();
            modalqty.innerHTML = 'Current Quantity: ' + row.cells[2].textContent;
            orderID.value = row.cells[0].textContent;
            shifee.value = row.cells[8].textContent;
			refillcost.value = row.cells[7].textContent;
			pymentMeth.value = row.cells[4].textContent;
        }
	</script>
	<script>
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
        var url_link;
        function cancelData(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
            // Get data from the row cells
            url_link = '/Refill-request/Request/Decline/' + row.cells[0].textContent;
        }     
        function CancelItem()
        {
           return  window.location.href = url_link;
        }
	</script>
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>

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

    @if (session('Cancelled'))
    <script>
        toastr.warning("Request has been cancelled", "Refill Request Cancelled", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
	{{-- Accepted --}}
	@if (session('Accepted'))
    <script>
        toastr.success('Refill Request has been accepted', "Accepted!", {
            closeButton: true,
            tapToDismiss: true, // prevent the toast from disappearing when clicked
            newestOnTop: true,
            positionClass: 'toast-top-right', // set the position of the toast
            preventDuplicates: true,
        }, 5000);
    </script>
    @endif
	{{-- Completed --}}
	@if (session('Completed'))
    <script>
        toastr.success('Refill Request has been Completed', "Completed!", {
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
        $(document).ready(function(){
            $.ajax({
                url: "{{ route('count_notif') }}",
                success: function(Appdata) {
                    $('.num').text(Appdata);
                }
                });
        });
    </script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
</body>
</html>
