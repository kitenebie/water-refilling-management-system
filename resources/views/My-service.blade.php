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
            @if (session()->get('auth') == 'Admin')
			    <li>
                    <a href="{{ route('orders') }}">
                        <i class='bx bxs-store' ></i>
                        <span class="text">Orders</span>
                    </a>
			    </li>
            @endif

                @if (session()->get('auth') == 'Admin')
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
                @if (session()->get('auth') == 'Reseller')
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
                @if (session()->get('auth') == 'Admin')
                    <li>
                        <i class='bx bxs-calendar-check' ></i>
                        <span class="text">
                            @if (isset($data_orders) && session()->get('auth') == env('USER_CREDINTIAL_ADMIN'))
                                <h3>{{ number_format($data_orders->count()) }}</h3>
                                <p>New Orders</p>
                            @else
                                <h3>0</h3>
                                <p>New Orders</p>
                            @endif
                        </span>
                    </li>
                @endif
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
                        <h3>PHP {{ session()->get('totalUserAmount') }}</h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>


			<div class="table-data" >
                @if (session()->get('auth') == 'Admin')
                        <div class="order" style="max-height: 620px">
                            <h3 style="position: sticky">Products</h3>
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
                                    @if(isset($productData))
                                        @foreach ($productData as $data_product)
                                            <tr>
                                                <td>
                                                    <img src="img/header-dashboard.png"/>
                                                    <p>{{ $data_product->product_Name }}</p>
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
                                    </tbody>
                                </table>
                            </div>
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

                    @if (session()->get('auth') == 'Reseller')
                        @if(isset($productData))
                            <div class="order">
                                <div class="head">
                                    <h2>POINT OF SALES</h2>
                                </div>
                                <form action="" method="post">
                                    @csrf
                                <div class="product-div">
                                    <label for="">Select Product</label>
                                    <Select class="inputs-products">
                                        <option value="">Gallon Round Water</option>
                                    </Select>
                                    <label for="">Quantity</label>
                                    <input type="text" name="" id="" class="inputs-products" placeholder="e.g., 10">
                                    <label for="">Price: </label>
                                    <label for="">Total Amount: </label>

                                    <div style="width:100%">
                                        <button type="reset" class="save-btn clear"><i class='bx bx-x' ></i> Clear</button>
                                        <button type="submit" class="save-btn"><i class='bx bx-save' ></i> Buy</button>
                                    </div>

                                    </form>
                                </div>
                            </div>
                            <div class="order">
                                <div class="head">

                                </div>
                            </div>
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
</body>
</html>

<!-- <td><span class="status completed">Completed</span></td> -->
</tr>
<!-- <tr>
    <td>
        <img src="img/people.png">
        <p>Kenneth Gimpao</p>
    </td>
    <td>03-19-2023</td>
    <td><span class="status process">Process</span></td>
</tr> -->
