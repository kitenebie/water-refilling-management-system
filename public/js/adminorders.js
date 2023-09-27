$('#gallon').hide();
$('#reset').on('click', ()=>{
    window.location.href = "{{ route('orders') }}";
});
$('#category').on("change",()=>{
    selectFunction();
});

// $('#table tr').click(function() {
//     var productNAme = $(this).find('td:first').text();
//     var productCost = $(this).find('td:nth-child(3)').text();
//     var productID = $(this).find('td:last').text();
//     $('#prdcost').val(productCost);
//     $('#productname').html('<option selected value="' + productNAme + '">' + productNAme + '</option>');
//     $('#product_ID').val(productID);
//     calculate();
// });