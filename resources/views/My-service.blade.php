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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
	<title>My Services</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="{{ asset('images/header-dashboard.png') }}" alt="" srcset="">
			<span class="text">Dashboard</span>
		</a>
		<ul class="side-menu top">
			<li class="">
				<a href="{{ route('dashboard') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
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
					<h1>Products</h1>
					<ul class="breadcrumb">
						<li>
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{ route('MyService') }}">Products</a>
						</li>
					</ul>
				</div>
				{{--  <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>  --}}
			</div>

			<div class="table-data" id="tableT">
                        <div class="order" style="max-height: 620px">
                            <div class="form-input2">
                                <h3>Products</h3>
                                <input type="search" name="search" id="search" placeholder="Search Product Name..." class="recent-search"><i tyle="cursor:text" class='bx bx-search' ></i>
                                <script>
                                    var input = document.getElementById("search");
                                    input.addEventListener("keyup", function() {
                                    this.value = this.value.toLowerCase();
                                    });
                                </script>
                            </div>
                            <div class="head">
                            </div>
                                    <table id="tableT">
                                        <thead>
                                            <tr>
                                                <th hidden></th>
                                                <th>Product Name</th>
                                                <th>Quantity Stocks</th>
                                                <th>Price</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                            @if(isset($productData))
                                                @foreach ($productData as $data_product)
                                                    <tr id="existingData">
                                                        <td class="uppercase-text" style="display: none">{{ $data_product->id }}</td>
                                                        <td  class="uppercase-text" data-value="{{ $data_product->product_Name }}">
                                                            {{ strtolower($data_product->product_Name) }}
                                                        </td>
                                                        <td>{{ $data_product->stocks }}</td>
                                                        <td>Php {{ $data_product->price }}</td>
                                                        <td style="display:grid; place-items: end">
                                                                    <a class="asddnewStocks" href="/Add-Stock/{{ $data_product->id }}">
                                                                        <i class='bx bxs-cart' ></i>
                                                                        <span class="text">Add New Stock</span>
                                                                    </a>
                                                                    {{-- href="/del-product/{{ $data_product->id }}" --}}
                                                                    <a id="openModal" onclick="printRowData(this)" style="border:1px solid transparent; outline: none; cursor:pointer; margin-top: 4px"  class="delprd">
                                                                        <i class='bx bxs-trash' ></i>
                                                                        <span class="text">Delete Product</span>
                                                                    </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                        @if (session()->get('auth')==env('USER_CREDINTIAL_RESELLER'))
                                            @if(isset($ResellerProduct))
                                                @foreach ($ResellerProduct as $RessellerPRDT)
                                                    <tr id="existingData">
                                                        <td class="uppercase-text" data-value="{{ $RessellerPRDT->product_Name }}">
                                                            {{ $RessellerPRDT->product_Name }}
                                                        </td>
                                                        <td>{{ $RessellerPRDT->Quantity }}</td>
                                                        <td>Php {{ $RessellerPRDT->Price }}</td>
                                                        <td hidden>{{ $RessellerPRDT->Price }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                @if(session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                    <div class="">
                        <form action="{{ route('saving_product') }}" method="post">
                            @csrf
                            <div class="head">
                                <h3>Add New Products</h3>
                            </div>
                            <div class="product-div">
                                <label for="">Product Name</label>
                                <input style="color: inherit !important;" required type="text" name="product_Name" id="" class="inputs-products">
                                <label for="">Product Price (php)</label>
                                <input style="color: inherit !important;" required type="text" name="product_Price" id="pdprice" class="inputs-products">
                                <label for="">Product Quatity Stocks</label>
                                <input style="color: inherit !important;" required type="text" name="product_qty" id="pqtystock" class="inputs-products">
                                <br><div style="width:100%">
                                    <button style="background:rgb(233, 49, 35);color: white" type="reset" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                    <button style="background: #3c94e6;color: white" type="submit" class="save-btn"><i class='bx bx-save' ></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

                    @if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                        @if(isset($ResellerProduct))
                            <div class="order">
                                <div class="head">
                                    <h2>POINT OF SALES</h2>
                                </div>
                                <form action="{{ route('RessellerProductAddToSales') }}" method="post">
                                <div class="product-div">
                                    <label for="">Purchase Type</label>
                                    <Select name="Ptype" onchange="purchase_type()" id="Ptype" class="inputs-products">
                                        <option value="0" selected>Purchase</option>
                                        <option selected value="1" selected>Refill</option>
                                    </Select>
                                </div><br>
                                    @csrf
                                <div class="product-div" id="BuyItems">
                                    <label for="">Select Product</label>
                                    <Select id="prdctNames" class="inputs-products">
                                    </Select>
                                    <label for="">Quantity</label>
                                    <input type="number" id="Cqty" name="Cqty" class="inputs-products" placeholder="e.g., 10" value="0">
                                    <label for="" id="lblselectedPrice">Price: </label>
                                    <input hidden type="text" id="selectedPrice">
                                    <label for="" id="selectedToatalAmount">Total Amount: </label>
                                    <input hidden style="border: none" type="text" name="total_amount" id="total_amount">
                                    <input hidden style="border: none" type="text" name="product_id" id="product_id">
                                    <div style="width:100%">
                                        <button style="background:rgb(233, 49, 35);color: white" type="reset" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                        <button style="background: #3c94e6;color: white" type="submit" id="submitbtn" class="save-btn"><i class='bx bx-save' ></i> Submit</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('AddRefillSale') }}" method="post">
                                @csrf
                                <div class="product-div" id="Fillwater">
                                    <label for="">Number of Gallon</label>
                                    <input type="number" id="numberOFgallon" name="numberOFgallon" class="inputs-products" placeholder="e.g., 10" value="0">
                                    <label for="">Refill Cost</label>
                                    <input type="number" id="refillCost" name="refillCost" class="inputs-products" placeholder="e.g., 10" value="0">
                                    <label for="" id="refillToatalAmount">Total Amount: </label>
                                    <input hidden  style="border: none" type="text" name="refilltotal_amount" id="refilltotal_amount">
                                    <div style="width:100%">
                                        <button style="background:rgb(233, 49, 35); color: white" type="reset" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                        <button style="background: #3c94e6; color: white" type="submit" id="Refillsubmitbtn" class="save-btn"><i class='bx bx-save' ></i> Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </form>
                            </div>
                            <div class="order">

                        @endif
                    @endif
                </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

    <div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                      <p class="text-sm text-gray-500">Are you sure you want to <strong class="text-red-500">Delete</strong> this product? All of the data will be removed. This action cannot be undone.</p>
                      <input type="text" id="itemID">
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button onclick="delteItem()" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
                <button id="closeModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <script>
        const title = document.getElementById('modal-title');
        var url_link;
        function printRowData(button) {
            // Get the row that contains the clicked button
            var row = button.parentNode.parentNode;
            // Get data from the row cells
            title.innerHTML = 'Product: ' + row.cells[1].textContent.toUpperCase();
            url_link = `/del-product/${encodeURIComponent(row.cells[0].textContent)}`;
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

    <script src="{{ asset('js/numberonly.js') }}"></script>
    <script src="{{ asset('js/textonly.js') }}"></script>
	<script src="{{ asset('js/dashboard.js') }}"></script>
    {{--  <script src="{{ env('JQUERY_AJAX_URL') }}"></script>  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mySelect').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.location.href=url;
                }
            });
        });
    </script>

    <script src="js/scripts.js"></script> <!-- Custom scripts -->
    <link rel="stylesheet" href="{{ env('TOASTR_URL_CSS') }}">
    <script src="{{ env('JQUERY_AJAX_URL') }}"></script>
    <script src="{{ env('TOASTR_URL_JQUERY') }}"></script>
    <script src="{{ env('TOASTR_URL_MIN_JS') }}"></script>
    <script src="{{ env('TOASTR_JQUERY_LINK') }}"></script>

    <script>
        $('document').ready(function(){
            getData();
            calculateBuy();
            if($('#Cqty').val() == 0){
                $("#submitbtn").prop('disabled','true');
            }
            $('#prdctNames').on('change', ()=>{
                $('#Cqty').val(0);
                getData();
                calculateBuy()
            });
            function getData(){
                $.ajax({
                    url: "{{ route('ResellerProductPrice') }}",
                    type: "GET",
                    success: handleResponse,
                });
            }
            // Create a function to handle the Ajax response
            function handleResponse(data) {
                console.log(data);
                $('#product_id').val(data[$('#prdctNames').val()].product_ID);
                $('#selectedPrice').val(data[$('#prdctNames').val()].Price);
                $('#Cqty').attr("max", data[$('#prdctNames').val()].Quantity);
                $('#lblselectedPrice').text('Price: '+data[$('#prdctNames').val()].Price)
                calculateBuy();
            }
            $('#Cqty').on('input', ()=>{
                if($('#Cqty').val() == 0){
                    $("#submitbtn").prop('disabled','true');
                }
                var length = $('#Cqty').val().length
                if(length==0){
                    $('#Cqty').val(0)
                }
                calculateBuy();
            })
            function calculateBuy(){
                if($('#selectedPrice').val()==0 || $('#Cqty').val()==0){
                    $('#submitbtn').prop('disabled', true);
                }else{
                    $('#submitbtn').prop('disabled', false);
                }
                const TotalAmountPrice = parseFloat($('#selectedPrice').val()) * parseFloat($('#Cqty').val());
                const formattedNumber = TotalAmountPrice.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 3,
                });
                $('#total_amount').val(TotalAmountPrice);
                $('#selectedToatalAmount').text('Total Amount: ' + formattedNumber);
            }
        });
        purchase_type();
        function purchase_type(){
            if($('#Ptype').val()==0){
                $("#BuyItems").show();
                $("#Fillwater").hide();
            }
            if($('#Ptype').val()==1){
                $("#Fillwater").show();
                $("#BuyItems").hide();
            }
        }
    </script>
@if (session('updated'))
<script>
    toastr.success("New stock has been added", 'Successfully Updated!',  {
        closeButton: true,
        tapToDismiss: true, // prevent the toast from disappearing when clicked
        newestOnTop: true,
        positionClass: 'toast-top-right', // set the position of the toast
        preventDuplicates: true,
    }, 5000);
</script>
@endif
@if (session('delete'))
<script>
    toastr.success("Product has been Deleted", 'Successfully Deleted',  {
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
            toastr.success("New product has been added", 'Successfully Saved',  {
                closeButton: true,
                tapToDismiss: true, // prevent the toast from disappearing when clicked
                newestOnTop: true,
                positionClass: 'toast-top-right', // set the position of the toast
                preventDuplicates: true,
            }, 5000);
        </script>
    @endif
    @if (session('deleted'))
        <script>
            toastr.success("Product has been deleted", 'Successfully Deleted',  {
                closeButton: true,
                tapToDismiss: true, // prevent the toast from disappearing when clicked
                newestOnTop: true,
                positionClass: 'toast-top-right', // set the position of the toast
                preventDuplicates: true,
            }, 5000);
        </script>
    @endif
    @if (session('AddedSales'))
        <script>
            toastr.success("Product has been Purchased", 'Successfully Submitted!',  {
                closeButton: true,
                tapToDismiss: true, // prevent the toast from disappearing when clicked
                newestOnTop: true,
                positionClass: 'toast-top-right', // set the position of the toast
                preventDuplicates: true,
            }, 5000);
        </script>
    @endif
    @if (session('refilled'))
        <script>
            toastr.success("Refilled", 'Successfully Submitted!',  {
                closeButton: true,
                tapToDismiss: true, // prevent the toast from disappearing when clicked
                newestOnTop: true,
                positionClass: 'toast-top-right', // set the position of the toast
                preventDuplicates: true,
            }, 5000);
        </script>
    @endif
    <script>
        var count = 0;
        $('table td:first-child').each(function() {
            var value = $(this).text();
            $('#prdctNames').append('<option value="' + count + '">' + value + '</option>');
            count = count+1;
        });
    </script>
    <script>
        $('document').ready(()=>{
            setTotaltoZero()
            refillCostCalculateToatal();
            $('#numberOFgallon').on('input', ()=>{
                refillCostCalculateToatal();
                setTotaltoZero()
            })
            $('#refillCost').on('input', ()=>{
                refillCostCalculateToatal();
                setTotaltoZero()
            })
            function refillCostCalculateToatal(){
                let numberOFgallon = $('#numberOFgallon').val();
                let refillCost = $('#refillCost').val();
                let refilltotal_amount = $('#refilltotal_amount').val();
                let refillTotalCost = parseFloat(numberOFgallon) * parseFloat(refillCost);
                const formattedNumber = refillTotalCost.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 3,
                });
                $('#refilltotal_amount').val(refillTotalCost)
                $('#refillToatalAmount').text('Total Amount: '+ formattedNumber)
                //alert(refilltotal_amount);
            }
            function setTotaltoZero(){
                if($('#refilltotal_amount').val() == 0.00 || $('#refilltotal_amount').val() == 0){
                    $('#Refillsubmitbtn').prop('disabled', true);
                }else{

                    $('#Refillsubmitbtn').prop('disabled', false);
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {

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
	<script src="{{ asset('js/amounts.js') }}"></script>
	<script src="{{ asset('js/localStorage.js') }}"></script>
    <script>
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
    </script>
    
    <style>
        .uppercase-text {
            text-transform: capitalize !important;
        }
    </style>
</body>
</html>
