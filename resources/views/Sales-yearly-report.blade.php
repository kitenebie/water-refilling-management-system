<!DOCTYPE html>
<html>
<head>
    <title>Jonel's Water Refilling Station</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>Jonel's Water Refilling Station</h1>
    <p><strong>{{ $caption }}</strong>
        @if (isset($currentDate))
        | {{ $currentDate }}
        @endif
    </p><hr>
    <p style="font-size: 12px !important">{{ date('F j, Y \a\t h:i a') }} </p>
    <?php $countNUm = 1; ?>
    <div class="table-responsive">
        <table class="table table-sm">
        <thead>
                <tr>
                    <th style="font-size: 14px !important" scope="col"></th>
                    <th style="font-size: 14px !important" scope="col">Product ID</th>
                    <th style="font-size: 14px !important" scope="col">Quantity</th>
                    <th style="font-size: 14px !important" scope="col">Amount</th>
                    <th style="font-size: 14px !important" scope="col">Date</th>
                </tr>
        </thead>
            <tbody>
                @if ($SalesData->isEmpty())
                    <tr>
                        <td colspan="7">No Data</td>
                    </tr>
                @else
                    @foreach($SalesData as $allProductSalesRecord)
                    <tr>
                        <td style="font-size: 12px !important" class="text-small">{{ $countNUm++ }}</td>
                        <td style="font-size: 12px !important" class="text-small">{{ $allProductSalesRecord->ProductID }}</td>
                        <td style="font-size: 12px !important" class="text-center text-small" scope="row">{{ number_format($allProductSalesRecord->Quantity) }}</td>
                        <td style="font-size: 12px !important" class="text-small" scope="row"><span style="font-family: DejaVu Sans; sans-serif;">₱</span><span id="Amount">{{ number_format($allProductSalesRecord->Amount,2) }}</span></td>
                        <td style="font-size: 12px !important" class="text-center">{{ date('m/d/y', strtotime($allProductSalesRecord->created_at)) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td style="font-size: 14px !important" class="text-right" colspan="5"><strong>Total Quantity: </strong> {{ number_format($Qty) }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px !important"  class="text-right" colspan="5"><strong>Total Amount: </strong> <span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ number_format($NewtotalAmount,2) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
