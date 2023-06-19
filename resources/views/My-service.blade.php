<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

	<title>My Services</title>
</head>
<body onload="darkmode()">


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img style="margin: 5px" width="50px" height="50px" src="img/header-dashboard.png" alt="" srcset="">
			<span class="text">My Services</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="{{ route('dashboard') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li  class="active">
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
            @endif

                @if (session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
			    <li>
                    <a href="#">
                        <i class='bx bxs-group' ></i>
                        <span class="text">Resellers</span>
                    </a>

			    </li>
                <li>
                    <a href="#">
                        <i class='bx bxs-group' ></i>
                        <span class="text">Applicants</span>
                    </a>
                </li>
                @endif
                @if (session()->get('auth') == env('USER_CREDINTIAL_RESELLER'))
                <li>
                    <a href="#">
                        <i class='bx bxs-cart' ></i>
                        <span class="text">Request Order</span>
                    </a>
                </li>
                @endif
		</ul>
		<ul class="side-menu">
			<li>
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
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
                <a href="#" class="notification">
                    <i class='bx bxs-bell' ></i>
                    <span class="num">8</span>
                </a>
                <a href="#" class="profile">
                    <img src="{{ env('IMG_PROF') }}">
                </a>
            </div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>My Service</h1>
					<ul class="breadcrumb">
						<li>
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="{{ route('MyService') }}">My Service</a>
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
                                <h3>{{ $RecentOrders }}</h3>
                            @endif
                                <p>Orders</p>
                        </span>
                    </li>
                <li>
                    <i class='bx bxs-box' ></i>
                    <span class="text">
                        <h3>{{ session()->get('totalStock') }}</h3>
                        <p>Stocks</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-coin-stack' ></i>
                    <span class="text">
                        <h3>PHP {{ $TOTALAMOUNTSALE }}</h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>


			<div class="table-data" id="tableT">
                        <div class="order" style="max-height: 620px">
                            <div class="form-input2">
                                <h3>Products</h3>
                                <input type="search" name="search" id="search" placeholder="Search Product Name..." class="recent-search"><i tyle="cursor:text" class='bx bx-search' ></i>
                            </div>
                            <div class="head">
                            </div>
                                    <table>
                                        <thead>
                                            <tr>
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
                                                        <td data-value="{{ $data_product->product_Name }}">
                                                            {{ $data_product->product_Name }}
                                                        </td>
                                                        <td>{{ $data_product->stocks }}</td>
                                                        <td>Php {{ $data_product->price }}</td>
                                                        <td style="display:grid; place-items: end">
                                                            <ul class="side-menu">
                                                                <li>
                                                                    <a class="asddnewStocks" href="/Add-Stock/{{ $data_product->id }}">
                                                                        <i class='bx bxs-cart' ></i>
                                                                        <span class="text">Add New Stock</span>
                                                                    </a>
                                                                </li><br>
                                                                <li>
                                                                    <a class="delprd" href="/del-product/{{ $data_product->id }}">
                                                                        <i class='bx bxs-trash' ></i>
                                                                        <span class="text">Delete Product</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                        @if (session()->get('auth')==env('USER_CREDINTIAL_RESELLER'))
                                            @if(isset($ResellerProduct))
                                                @foreach ($ResellerProduct as $RessellerPRDT)
                                                    <tr id="existingData">
                                                        <td data-value="{{ $RessellerPRDT->product_Name }}">
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
                                {{--  <label for="">Product Image</label>
                                <input type="file" name="" id="" class="inputs-products">  --}}
                                <label for="">Product ID</label>
                                <input style="color: inherit !important;" required type="text" name="product_ID" id="" class="inputs-products">
                                <label for="">Product Name</label>
                                <input style="color: inherit !important;" required type="text" name="product_Name" id="" class="inputs-products">
                                <label for="">Product Price (php)</label>
                                <input style="color: inherit !important;" required type="text" name="product_Price" id="" class="inputs-products">
                                <label for="">Product Quatity Stocks</label>
                                <input style="color: inherit !important;" required type="text" name="product_qty" id="" class="inputs-products">
                                <br><div style="width:100%">
                                    <button type="reset" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                    <button type="submit" class="save-btn"><i class='bx bx-save' ></i> Save</button>
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
                                <div class="product-div">
                                    <label for="">Purchase Type</label>
                                    <Select onchange="purchase_type()" id="Ptype" class="inputs-products">
                                        <option value="0" selected>Buy</option>
                                        <option selected value="1" selected>Refill</option>
                                    </Select>
                                </div><br>
                                <form action="{{ route('RessellerProductAddToSales') }}" method="post">
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
                                        <button type="reset" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                        <button type="submit" id="submitbtn" class="save-btn"><i class='bx bx-save' ></i> Submit</button>
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
                                    <input hidden style="border: none" type="text" name="refilltotal_amount" id="refilltotal_amount">
                                    <div style="width:100%">
                                        <button type="reset" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                        <button type="submit" id="Refillsubmitbtn" class="save-btn"><i class='bx bx-save' ></i> Submit</button>
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
            calculateBuy()
            $('#prdctNames').on('change', ()=>{
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
                $('#product_id').val(data[$('#prdctNames').val()].product_ID);
                $('#selectedPrice').val(data[$('#prdctNames').val()].Price);
                $('#lblselectedPrice').text('Price: '+data[$('#prdctNames').val()].Price)
                calculateBuy();
            }
            $('#Cqty').on('input', ()=>{
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
                const FinalTotalAmountPrice = TotalAmountPrice.toFixed(2);
                $('#total_amount').val(TotalAmountPrice);
                $('#selectedToatalAmount').text('Total Amount: ' + FinalTotalAmountPrice);
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
            $('#numberOFgallon').on('input', ()=>{
                refillCostCalculateToatal();
            })
            $('#refillCost').on('input', ()=>{
                refillCostCalculateToatal();
            })
            function refillCostCalculateToatal(){
                let numberOFgallon = $('#numberOFgallon').val();
                let refillCost = $('#refillCost').val();
                let refilltotal_amount = $('#refilltotal_amount').val();
                let refillTotalCost = parseFloat(numberOFgallon) * parseFloat(refillCost);
                refilltotal_amount = refillTotalCost.toFixed(2);
                $('#refilltotal_amount').val(refilltotal_amount)
                $('#refillToatalAmount').text('Total Amount: '+refilltotal_amount)
                //alert(refilltotal_amount);
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
</body>
</html>
