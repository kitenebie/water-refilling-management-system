$('#gallon').hide();
$('#reset').on('click', ()=>{
    window.location.href = "{{ route('orders') }}";
});
$('#category').on("change",()=>{
    selectFunction();
});

$('#table tr').click(function() {
    var productNAme = $(this).find('td:first').text();
    var productCost = $(this).find('td:nth-child(3)').text();
    var productID = $(this).find('td:last').text();
    $('#prdcost').val(productCost);
    $('#productname').html('<option selected value="' + productNAme + '">' + productNAme + '</option>');
    $('#product_ID').val(productID);
    calculate();
});

$('#prdqty').on('input', ()=>{
    calculate();
});

$('#prdcost').on('input', ()=>{
    calculate();
});
function calculate(){
    let totalCost =$('#prdqty').val() * $('#prdcost').val();
    $('#prdtotal').val(totalCost.toFixed(2));
}
//$('#pymnt').on('change', ()=>{
//    resellerCal();
//});
//function resellerCal(){
//if($('#pymnt').val() == "Walk in"){
//    $('#sfeelbl').hide();
//    $('#prdfee').val(0);
//    $('#prdfee').hide();
//    calculate();
//}else{
//    $('#sfeelbl').show();
//    $('#prdfee').show();
//    $('#prdfee').val(5);
//    calculate();
//}
//}