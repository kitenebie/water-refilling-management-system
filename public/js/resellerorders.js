
$(document).ready(()=>{
    $('#RefillRequest').hide()
    $('#category').on('change',()=>{
        if($('#category').val()==0){
            $('#PurchaseRequest').hide()
            $('#RefillRequest').show()
        }
        if($('#category').val()==1){
            $('#PurchaseRequest').show()
            $('#RefillRequest').hide()
        }
    });
    $('#numberGalllon').on('input', ()=>{
        ResellerRefilCaculate();
    });
    $('#refillcost').on('input', ()=>{
        ResellerRefilCaculate();
    });
    $('#refillfee').on('input', ()=>{
        ResellerRefilCaculate();
    });
    function ResellerRefilCaculate(){
        const numberGalllon = $('#numberGalllon').val();
        const refillcost = $('#refillcost').val();
        const refillfee = $('#refillfee').val();
        const refilltotal = $('#refilltotal');
        const refilltotalamount = parseInt(numberGalllon)*(parseFloat(refillcost)+parseFloat(refillfee));
        if(refilltotalamount !== refilltotalamount){
            return refilltotal.val(parseFloat(0.00));  
        }
        refilltotal.val(refilltotalamount.toFixed(2));
    }
    $('#table tr').click(function() {
        var productNAme = $(this).find('td:first').text();
        var productCost = $(this).find('td:nth-child(3)').text();
        var productID = $(this).find('td:last').text();
        $('#prdcost').val(productCost);
        $('#productname').html('<option selected value="' + productNAme + '">' + productNAme + '</option>');
        $('#product_ID').val(productID);
    });

    $('#prdqty').on('input', ()=>{
        calculate();
    });

    $('#prdcost').on('input', ()=>{
        calculate();
    });
    function calculate(){
        let calFee = $('#prdfee').val() * $('#prdqty').val();
        let totalCost =$('#prdqty').val() * $('#prdcost').val() + calFee;
        $('#prdtotal').val(totalCost.toFixed(2));
    }
//</script>addmin
   
});