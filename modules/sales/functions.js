$(document).ready(function () {
  $("#sold").on("change", function () {
    var soldValue = parseFloat($(this).val());

    var item_id = $("#item_id").val();

    $.ajax({
      type: "POST",
      url: "ajax-calls.php",
      data: { item_id: item_id },
      dataType: "json",
      success: function (response) {
        var available = parseFloat(response.avail);
        var sold = parseFloat(response.sold) || 0;
        var price = parseFloat(response.cost_price) || 0;
        var discount = parseFloat(response.discount) || 0;
        if (sales_id > 0) {
          avail = sold + available;
        } else {
          avail = available;
        }

        if (soldValue <= avail) {
          var totalPrice = soldValue * price;

          // Calculate discount and subtotal
          var discountPrice = (totalPrice * discount) / 100;
          var subtotal = totalPrice - discountPrice;

          $("#price").val(totalPrice);
          $("#discount").val(discount);
          $("#subtotal").val(subtotal);

          // Calculate total paid
          var delivery = parseFloat($("#delivery").val()) || 0;
          var processFee = parseFloat($("#process_fee").val()) || 0;
          var otherAmount = parseFloat($("#other_amount").val()) || 0;
          var total = subtotal + delivery + processFee + otherAmount;

          // Update the total input field
          $("#total").val(total);
          $("#saleBtn").prop("disabled", false);
        } else {
          var toastType = "danger";
          var toastMsg = "Current available items are " + available;
          showToast(toastType, toastMsg);

          $("#saleBtn").prop("disabled", true);
          return;
        }
      },
    });
  });

  $("#process_fee").on("change", function () {
    var subtotal = parseFloat($("#subtotal").val()) || 0;
    var delivery = parseFloat($("#delivery").val()) || 0;
    var otherAmount = parseFloat($("#other_amount").val()) || 0;
    var processFee = parseFloat($("#process_fee").val()) || 0;

    var total = subtotal + delivery + processFee + otherAmount;

    // Update the total input field
    $("#total").val(total);
  });

  $("#other_amount").on("change", function () {
    var subtotal = parseFloat($("#subtotal").val()) || 0;
    var delivery = parseFloat($("#delivery").val()) || 0;
    var otherAmount = parseFloat($("#other_amount").val()) || 0;
    var processFee = parseFloat($("#process_fee").val()) || 0;

    var total = subtotal + delivery + processFee + otherAmount;

    // Update the total input field
    $("#total").val(total);
  });
  $("#delivery").on("change", function () {
    var subtotal = parseFloat($("#subtotal").val()) || 0;
    var delivery = parseFloat($("#delivery").val()) || 0;
    var otherAmount = parseFloat($("#other_amount").val()) || 0;
    var processFee = parseFloat($("#process_fee").val()) || 0;

    var total = subtotal + delivery + processFee + otherAmount;

    // Update the total input field
    $("#total").val(total);
  });

  if (sales_id > 0) {
    $("#sold").prop("disabled", false);
  }
});

function check(item_id, sales_id) {
  if (item_id == "") {
    $("#sold").prop("disabled", true);
  } else {
    $("#sold").prop("disabled", false);
  }
}

function get_discount(cust_id) {
  $.ajax({
    url: "ajax-calls.php",
    type: "POST",
    data: {ACTION:"get_discount",cust_id:cust_id},
    success: function (data) {
       $('#discount_1').val(data);
    },
  });
}
function find_price(retail_price){
 var discount =  $('#discount_1').val();
 var discount_2 =  $('#discount_2').val();
 if(discount_2 != ''){
  discount = discount_2;
 }
 var discount_value = (retail_price * discount) / 100;
 var cost_price = retail_price - discount_value;
 $('#cost_price').val(cost_price);
 $('#total').val(cost_price);
}
function add_discount(value){
 var retail_price =  $('#retail_price').val();
 var discount_value = (retail_price * value) / 100;
 var cost_price = retail_price - discount_value;
 $('#cost_price').val(cost_price);
 $('#total').val(cost_price);


}
function generate_picklist(sales_id){
  
}