
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Stocks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @if($Product)
            @foreach ($Product as $DaTA)
            <div class="w-full max-w-md mx-auto mt-8 bg-white p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-6 text-center">ADD NEW STOCKS</h1>
                <form class="space-y-6" action="{{ route('updateStocks') }}" method="post">
                    @csrf
                    <input type="text" value="{{ $DaTA->id }}" name="prd_ID" id="" hidden>
                <div>
                    <label for="text" class="block text-gray-700 font-bold mb-2">Product Name: {{ $DaTA->product_Name }}</label>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-bold mb-2">Current Stocks: {{ $DaTA->stocks }}</label>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 font-bold mb-2">Add New Stocks (QTY): </label>
                    <input name="qtyStocks" id="addqtyStocks" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., 100">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Stocks
                    </button>
                    <a href="{{ route('MyService') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Close
                    </a>
                </div>
                </form>
            </div>
            @endforeach
      @endif
      <script src="{{ asset('js/numberonly.js') }}"></script>
</body>
</html>
