<!DOCTYPE html>
<html>
<head>
    <title>Jonel's Water Refilling Station</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h2>Jonel's Water Refilling Station</h2>
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
                    <th style="font-size: 14px !important" scope="col">Seller Name</th>
                    @if (isset($Sales))
                    <th style="font-size: 14px !important" scope="col">Product Name</th>
                    @endif
                    <th style="font-size: 14px !important" scope="col">Quantity</th>
                    <th style="font-size: 14px !important" scope="col">Amount</th>
                    <th style="font-size: 14px !important" scope="col">Payment Method</th>
                    <th style="font-size: 14px !important" scope="col">Date Purchase</th> 
                </tr>
        </thead>
            <tbody>
                @if (isset($refills))
                    @foreach($refills as $refill)
                    <tr>
                        <td style="font-size: 12px !important" class="text-small">{{ $refill->lastname }}, {{ $refill->firstname }}</td>
                        <td style="font-size: 12px !important" class="text-small">{{ number_format($refill->NumberOfGallon) }}</td>
                        <td style="font-size: 12px !important" class="text-center text-small" scope="row"><span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ $refill->TotalCost }}</td>
                        <td style="font-size: 12px !important" class="text-small" scope="row"><span id="Amount">{{ $refill->paymentMethod }}</span></td>
                        <td style="font-size: 12px !important" class="text-center">{{ Carbon\Carbon::parse($refill->created_at)->format('F j, Y') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td style="font-size: 14px !important" class="text-right" colspan="5"><strong>Total Quantity: </strong> {{ number_format($Qty) }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px !important"  class="text-right" colspan="5"><strong>Total Amount: </strong> <span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ number_format($NewtotalAmount,2) }}</td>
                    </tr>
                    @endif

                    
                @if (isset($Sales))
                @foreach($Sales as $sale)
                <tr>
                    <td style="font-size: 12px !important" class="text-small">{{ $sale->lastname }}, {{ $sale->firstname }}</td>
                    <td style="font-size: 12px !important" class="text-small">{{ $sale->product_Name }}</td>
                    <td style="font-size: 12px !important" class="text-small">{{ number_format($sale->order) }}</td>
                    <td style="font-size: 12px !important" class="text-center text-small" scope="row"><span style="font-family: DejaVu Sans; sans-serif;">₱</span>{{ $sale->Amount }}</td>
                    <td style="font-size: 12px !important" class="text-small" scope="row"><span id="Amount">{{ $sale->paymentMethod }}</span></td>
                    <td style="font-size: 12px !important" class="text-center">{{ Carbon\Carbon::parse($sale->created_at)->format('F j, Y') }}</td>
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
