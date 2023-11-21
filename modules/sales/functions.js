
$(document).ready(function() {


    $('#sold').on('change', function() {
        var soldValue = parseFloat($(this).val());

        var item_id = $('#item_id').val();

        $.ajax({
            type: 'POST',
            url: 'ajax-calls.php',
            data: { item_id: item_id },
            dataType: 'json',
            success: function(response) {
                var price = parseFloat(response.cost_price) || 0;
                var discount = parseFloat(response.discount) || 0;

                var totalPrice = soldValue * price;

                // Calculate discount and subtotal
                var discountPrice = (totalPrice * discount)/100;

                var subtotal =totalPrice - discountPrice;
                

                $('#price').val(totalPrice);
                $('#discount').val(discount);
                $('#subtotal').val(subtotal);

                // Calculate total paid
                var delivery = parseFloat($('#delivery').val()) || 0;
                var processFee = parseFloat($('#process_fee').val()) || 0;
                var otherAmount = parseFloat($('#other_amount').val()) || 0;
                var total = subtotal + delivery + processFee + otherAmount;

                // Update the total input field
                $('#total').val(total);
            }
        });
    });

    $('#process_fee').on('change', function() {

        var subtotal = parseFloat($('#subtotal').val()) || 0;
        var delivery = parseFloat($('#delivery').val()) || 0;
        var otherAmount = parseFloat($('#other_amount').val()) || 0;
        var processFee = parseFloat($('#process_fee').val()) || 0;
        
        var total = subtotal + delivery + processFee + otherAmount;

        // Update the total input field
        $('#total').val(total);
        
    });

    $('#other_amount').on('change', function() {

        var subtotal = parseFloat($('#subtotal').val()) || 0;
        var delivery = parseFloat($('#delivery').val()) || 0;
        var otherAmount = parseFloat($('#other_amount').val()) || 0;
        var processFee = parseFloat($('#process_fee').val()) || 0;

        var total = subtotal + delivery + processFee + otherAmount;

        // Update the total input field
        $('#total').val(total);
    
    });
});

function check(item_id){
    if(item_id == ''){
        $('#sold').prop('disabled',true);
    }
    else{
        $('#sold').prop('disabled',false);
    }
}