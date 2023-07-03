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
                    <th style="font-size: 14px !important" scope="col">FullName</th>
                    <th style="font-size: 14px !important" scope="col">Address</th>
                    <th style="font-size: 14px !important" scope="col">Product</th>
                    <th style="font-size: 14px !important" scope="col">Quantity</th>
                    <th style="font-size: 14px !important" scope="col">Amount</th>
                    <th style="font-size: 14px !important" scope="col">Remarks</th>
                </tr>
        </thead>
            <tbody>
                @if ($Orders->isEmpty())
                    <tr>
                        <td colspan="7">No Data</td>
                    </tr>
                @else
                    @foreach($Orders as $Order)
                    <tr>
                        <td style="font-size: 12px !important" class="text-small">{{ $countNUm++ }}</td>
                        <td style="font-size: 12px !important" class="text-small">{{ $Order->lastname }}, {{ $Order->firstname }}</td>
                        <td style="font-size: 12px !important" class="text-small">{{ $Order->address }}</td>
                        <td style="font-size: 12px !important" class="text-small">{{ $Order->product_Name }}</td>
                        <td style="font-size: 12px !important" class="text-center text-small" scope="row">{{ number_format($Order->order) }}</td>
                        <td style="font-size: 12px !important" class="text-small" scope="row"><span style="font-family: DejaVu Sans; sans-serif;">₱</span><span id="Amount">{{ number_format($Order->Amount,2) }}</span></td>
                        <td style="font-size: 12px !important" class="text-center"><input type="checkbox" name="" id=""></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="5"><strong>Total Amount: </strong></td>
                        <td class="text-left" colspan="2" scope="row"><span style="font-family: DejaVu Sans; sans-serif;">₱</span><span id="totalAmount">{{ number_format($NewtotalAmount,2) }}</span></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>