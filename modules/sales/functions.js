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

function get_product_details(item_id, sales_id) {
  if (item_id == "") {
    
  } else {
    $.ajax({
      url: "ajax-calls.php",
      type: "POST",
      data: {ACTION:"get_product_name_location",item_id:item_id},
      dataType: "json",
      success: function (response) {
        $("#prod_details").html(response.html);
      }
    });
  }
}
function check_quantity(value){
  if(value != ''){
    var avail = $('#avail-quantity').val();
  
    if(value > avail){
      var toastType = 'danger';
      var toastMsg = 'Quantity not available';
      showToast(toastType, toastMsg);
      return;
    }
  }

}

function get_discount(cust_id) {
  if(cust_id != ''){
    $.ajax({
      url: "ajax-calls.php",
      type: "POST",
      data: {ACTION:"get_discount",cust_id:cust_id},
      success: function (data) {
         $('#discount_1').val(data);
      },
    });
  }else{

  }
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
  $.ajax({
    type: "POST",
    url: "ajax-calls.php",
    data: { ACTION: "picklist", sales_id: sales_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#sales_id").val(sales_id);
      $("#date").val(json.date);
      $("#customer_name").val(json.customer_name);
      $("#product_name").val(json.product_name);
      $("#quantity").val(json.quantity);
      $("#location").val(json.location);
      tinymce.get("details").setContent(json.details);
      $("#picklist_id").val(json.picklist_id).trigger('change');
      clearFormValidation("#picklist_form");
      $("#picklist_Modal").modal("toggle");
    },
  });
}
function save_delivery(deliveryValue,invoice_number,subtotal) { 
  var deliveryNumber = parseFloat(deliveryValue);
  var subtotalNumber = parseFloat(subtotal);

  var process = parseFloat($('#process').val());
  var other = parseFloat($('#other').val());
  var grand = subtotalNumber + deliveryNumber + process + other; 
  $.ajax({
      url: 'ajax-calls.php', 
      method: 'POST',
      data: {
          ACTION: "save_delivery",
          delivery: deliveryValue,
          invoice_number: invoice_number,
          grand:grand
      },
      success: function(response) {
        $('.grand-total').html(grand);
      }
  });
}
function save_process(processValue,invoice_number,subtotal) { 
  var processValue = parseFloat(processValue);
  var subtotalNumber = parseFloat(subtotal);
  var delivery = parseFloat($('#delivery').val());
  var other = parseFloat($('#other').val());
  var grand = subtotalNumber + processValue + delivery + other; 
  $.ajax({
      url: 'ajax-calls.php', 
      method: 'POST',
      data: {
          ACTION: "save_process",
          process: processValue,
          invoice_number: invoice_number,
          grand:grand
      },
      success: function(response) {
        $('.grand-total').html(grand);
      }
  });
}
function save_other(otherValuue,invoice_number,subtotal) { 
  var otherValuue = parseFloat(otherValuue);
  var subtotalNumber = parseFloat(subtotal);
  var delivery = parseFloat($('#delivery').val());
  var process = parseFloat($('#process').val());
  var grand = subtotalNumber + otherValuue + delivery + process; 
  $.ajax({
      url: 'ajax-calls.php', 
      method: 'POST',
      data: {
          ACTION: "save_other",
          other: otherValuue,
          invoice_number: invoice_number,
          grand:grand
      },
      success: function(response) {
        $('.grand-total').html(grand);
      }
  });
}
function save_details(value,invoice_number) { 
  var  value = value.trim();
  $.ajax({
      url: 'ajax-calls.php', 
      method: 'POST',
      data: {
          ACTION: "save_details",
          value: value,
          invoice_number: invoice_number
      },
      success: function(response) {
      }
  });
}
function formSubmit() {
  var form = $("#picklist_form")[0];
  if (!form.checkValidity()) {
    return;
  }

  var formData = new FormData(form);

  $.ajax({
    type: "POST",
    url: "save_picklist.php",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function () {
      $(".preloader").removeClass("d-none");
      $(".submit-btn").prop("disabled", true);
    },
    success: function (response) {
      var json = JSON.parse(response);

      $(".preloader").removeClass("d-none");

      setTimeout(function () {
        if (json.status == "danger") {
          var toastType = json.status;
          var toastMsg = json.value;
          showToast(toastType, toastMsg);
          $('.preloader').addClass('d-none');
          $('.submit-btn').prop('disabled',false);
        } else {
          var toastType = json.status;
          var toastMsg = json.value;
          showToast(toastType, toastMsg);
          $("#picklist_Modal").modal("toggle");
          window.location.reload();
          //loadTable();
        }
      }, 2000);
    },
    complete: function () {
      $(".preloader").removeClass("d-none");
    },
  });
}

function save_data() {
  $('#saved_sale').toggleClass('d-none', false);
  $('#saleBtn').toggleClass('d-none', false);
  
  var item_id = $('#item_id').val();
  var location = $('#loc_id option:selected').text();
  var loc_id = $('#loc_id').val();
  var date = $('#date').val();
  var customer = $('#customer_id option:selected').text();
  var customer_id = $('#customer_id').val();
  var quantity = $('#quantity').val();
  var costPrice = $('#cost_price').val();
  var retailPrice = $('#retail_price').val();
  var total = $('#total').val();
  var details = $('#details').val();
  var discount_1 = $('#discount_1').val();
  var discount_2 = $('#discount_2').val();
  if (discount_1 === '') {
    discount_1 = 0;
  }

  if (discount_2 === '') {
    discount_2 = 0;
  }

  // Create a table row and append data
  var newRow = `<tr>
      <td><input type="hidden" name="date[]" value="${date}">${date}</td>
      <td><input type="hidden" name="item_id[]" value="${item_id}">${item_id}</td>
      <td><input type="hidden" name="customer[]" value="${customer_id}">${customer}</td>
      <td><input type="hidden" name="quantity[]" value="${quantity}">${quantity}</td>
      <td><input type="hidden" name="location[]" value="${loc_id}">${location}</td>
      <td><input type="hidden" name="cost_price[]" value="${costPrice}">${costPrice}</td>
      <td><input type="hidden" name="retail_price[]" value="${retailPrice}">${retailPrice}</td>
      <td><input type="hidden" name="total[]" value="${total}">${total}</td>
      <td><input type="hidden" name="discount_1[]" value="${discount_1}">${discount_1}</td>
      <td><input type="hidden" name="discount_2[]" value="${discount_2}">${discount_2}</td>
  </tr>`;

  // Append the new row to the table body
  $('#saved_sale tbody').append(newRow);

  // Clear form fields
  $('#date').val('');
  $('#productName').val('');
  $('#avail-quantity').val('');
  $('#customer_id').val('').trigger('change');
  $('#item_id').val('').trigger('change');
  $('#loc_id').val('').trigger('change');
  $('#cost_price').val('');
  $('#retail_price').val('');
  $('#quantity').val('');
  $('#discount_1').val('');
  $('#discount_2').val('');
  $('#total').val('');
  //$("#salesForm")[0].reset();
}

function get_quantity(loc_id,item_id){
  if(loc_id != ''){
    $.ajax({
      url: "ajax-calls.php",
      type: "POST",
      data: {ACTION:"get_loc_quantity",loc_id:loc_id,item_id:item_id},
      success: function (data) {
         $('#avail-quantity').val(data);
      },
    });
  }else{

  }
}
function saleSubmit(){
  var allRows = [];

  // Loop through each table row
  $('#saved_sale tbody tr').each(function(index, row) {
    var rowData = {
      date: $(row).find('td:eq(0) input').val(),
      item_id: $(row).find('td:eq(1) input').val(),
      customer_id: $(row).find('td:eq(2) input').val(),
      quantity: $(row).find('td:eq(3) input').val(),
      location: $(row).find('td:eq(4) input').val(),
      cost_price: $(row).find('td:eq(5) input').val(),
      retail_price: $(row).find('td:eq(6) input').val(),
      total: $(row).find('td:eq(7) input').val(),
      discount_1: $(row).find('td:eq(8) input').val(),
      discount_2: $(row).find('td:eq(9) input').val(),
    };

    allRows.push(rowData);
  });
  
  $.ajax({
    url: 'save.php',
    method: 'POST',
    data: { allRows: allRows,'ACTION':'save' },
    success: function(response) {
      // var json = JSON.parse(response);
      // var toastType = json.status;
      // var toastMsg = json.value;
      // showToast(toastType, toastMsg);
      window.location.href="index.php";
    }
  });

}