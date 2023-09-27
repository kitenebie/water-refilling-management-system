<!DOCTYPE html>
<html lang="en" class="antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DataTables </title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
    <!--Replace with your tailwind.css once created-->


    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <style>
        /*Overrides for Tailwind CSS */

        /*Form fields*/
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            /*text-gray-700*/
            padding-left: 1rem;
            /*pl-4*/
            padding-right: 1rem;
            /*pl-4*/
            padding-top: .5rem;
            /*pl-2*/
            padding-bottom: .5rem;
            /*pl-2*/
            line-height: 1.25;
            /*leading-tight*/
            border-width: 2px;
            /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7;
            /*border-gray-200*/
            background-color: #edf2f7;
            /*bg-gray-200*/
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            /*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #669bea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #669bea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
            cursor: pointer;
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #669bea !important;
            /*bg-indigo-500*/
        }
    </style>



</head>

<body class="bg-gray-100 text-gray-500 tracking-wider leading-normal">


    <!--Container-->
    <div class="container w-full md:full xl:full  mx-auto px-2">

        <!--Title-->
        <h1 class="flex items-center font-sans font-bold break-normal text-blue-500 px-2 py-8 text-xl md:text-2xl">
            @if (isset($Sales))
            Product Sales Report From {{ $startDate }} to {{ $endDate }}
            @else
            Refill Sales Report From {{ $startDate }} to {{ $endDate }}
            @endif
        </h1>
        <h6 style="margin-bottom: 5px !important">
            <span><a href="/Sales" class="bg-blue-500 text-white px-2 py-2">Go Back</a></span>
            @if (isset($Sales))
            <span><a href="/Sales-report-pdf/{{ $startDate }}/{{ $endDate }}" class="bg-blue-500 text-white px-2 py-2">Print Report as PDF</a></span>
                <span><a href="/refill-report/{{ $startDate }}/{{ $endDate }}" class="bg-blue-500 text-white px-2 py-2">Show Refill Sales</a></span>
            @endif
            @if (isset($refills))
            <span><a href="/refill-report-pdf/{{ $startDate }}/{{ $endDate }}" class="bg-blue-500 text-white px-2 py-2">Print Report as PDF</a></span>
                <span><a href="/Sales-report/{{ $startDate }}/{{ $endDate }}" class="bg-blue-500 text-white px-2 py-2">Show Product Sales</a></span>
            @endif
        </h6>
        
        <!--Card-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            @if (isset($Sales))
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">Seller Name</th>
                        <th data-priority="2">Product Name</th>
                        <th data-priority="3">Quantity</th>
                        <th data-priority="4">Amount</th>
                        <th data-priority="6">Payment Method</th>
                        <th data-priority="5">Date Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($Sales->count() > 0)
                        @foreach ($Sales as $Sale)
                            <tr>
                                <td>{{ $Sale->lastname }}, {{ $Sale->firstname }}</td>
                                <td>{{ $Sale->product_Name }}</td>
                                <td>{{ $Sale->order }}</td>
                                <td> ₱{{  number_format($Sale->Amount,2) }}</td>
                                <td>{{ $Sale->paymentMethod }}</td>
                                <td>{{ Carbon\Carbon::parse($Sale->created_at)->format('F j, Y') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
            @endif


            @if (isset($refills))
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">Seller Name</th>
                        <th data-priority="3">Quantity</th>
                        <th data-priority="4">Amount</th>
                        <th data-priority="6">Payment Method</th>
                        <th data-priority="5">Date Purchase</th> 
                    </tr>
                </thead>
                <tbody>
                    @if ($refills->count() > 0)
                        @foreach ($refills as $refill)
                            <tr>
                                <td>{{ $refill->lastname }}, {{ $refill->firstname }}</td>
                                <td>{{ $refill->NumberOfGallon }}</td>
                                <td> ₱{{ number_format($refill->TotalCost,2) }}</td>
                                <td>{{ $refill->paymentMethod }}</td>
                                <td>{{ Carbon\Carbon::parse($refill->created_at)->format('F j, Y') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
            @endif
        </div>
        <!--/Card-->

    </div>
    <!--/container-->





    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {

            var table = $('#example').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>

</body>

</html>