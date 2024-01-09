function editFormSubmit() {
  var form = $("#edit_purchase_form")[0];
  if (!form.checkValidity()) {
    return;
  }
  var formData = $("#edit_purchase_form").serialize();
  $.ajax({
    type: "POST",
    url: "save.php",
    data: formData,
    beforeSend: function () {
      $(".preloader").removeClass("d-none");
      $(".edit-submit-btn").prop("disabled", true);
    },
    success: function (response) {
      var json = JSON.parse(response);

      $(".preloader").removeClass("d-none");
      setTimeout(function () {
        var toastType = json.status;
        var toastMsg = json.value;
        showToast(toastType, toastMsg);
        $("#edit_purchase_Modal").modal("toggle");
        loadTable();
      }, 2000);
    },
    complete: function () {
      $(".preloader").removeClass("d-none");
      $(".edit-submit-btn").prop("disabled", true);
    },
  });
}
function formSubmit(){
  var allRows = [];

  // Loop through each table row
  $('#saved_purchase tbody tr').each(function(index, row) {
    var rowData = {
      date: $(row).find('td:eq(0) input').val(),
      supplier_id: $(row).find('td:eq(1) input').val(),
      product_id: $(row).find('td:eq(2) input').val(),
      cost_price: $(row).find('td:eq(3) input').val(),
      retail_price: $(row).find('td:eq(4) input').val(),
      quantity: $(row).find('td:eq(5) input').val(),
      location: $(row).find('td:eq(6) input').val()
    };

    allRows.push(rowData);
  });
  
  $.ajax({
    url: 'save.php',
    method: 'POST',
    data: { allRows: allRows,'ACTION':'save' },
    beforeSend: function () {
      $(".preloader").removeClass("d-none");
      $(".submit-btn").prop("disabled", true);
    },
    success: function(response) {
      var json = JSON.parse(response);

      $(".preloader").removeClass("d-none");
      setTimeout(function () {
        var toastType = json.status;
        var toastMsg = json.value;
        showToast(toastType, toastMsg);
        $("#purchase_Modal").modal("toggle");
        loadTable();
      }, 2000);
    },
    complete: function () {
      $(".preloader").removeClass("d-none");
      $(".submit-btn").prop("disabled", true);
    },
  });

}
function add_purchase(purchase_id) {
  $("#purchase_Modal").modal("toggle");
}
function edit_purchase(purchase_id) {
  $.ajax({
    type: "POST",
    url: "ajax_calls.php",
    data: { ACTION: "purchase", purchase_id: purchase_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#purchase_idd").val(purchase_id);
      // $("#supplier_idd").val(json.supplier_id);
      $("#supplier_idd").val(json.supplier_id).trigger('change');
      $("#item_idd").val(json.item_id).trigger('change');;
      $("#datee").val(json.date);
      $("#cost_pricee").val(json.cost_price);
      $("#retail_pricee").val(json.retail_price);
      $("#quantityy").val(json.quantity);
      $("#locationn").val(json.location);

      clearFormValidation("#edit_purchase_form");

      $("#edit_purchase_Modal").modal("toggle");
    },
  });
}
loadTable();
function loadTable() {
  $("#loadTable").load("loadTable.php", function () {});
}
function save_data() {
  $('#saved_purchase').toggleClass('d-none', false);
  $('.submit-btn').toggleClass('d-none', false);

  var date = $('#date').val();
  var supplier = $('#supplier_id option:selected').text();
  var supplier_id = $('#supplier_id').val();
  var product_id = $('#product_id').val();
  var product = $('#product_id option:selected').text();
  var costPrice = $('#cost_price').val();
  var retailPrice = $('#retail_price').val();
  var quantity = $('#quantity').val();
  var location = $('#location').val();

  // Create a table row and append data
  var newRow = `<tr>
      <td><input type="hidden" name="date[]" value="${date}">${date}</td>
      <td><input type="hidden" name="supplier_id[]" value="${supplier_id}">${supplier}</td>
      <td><input type="hidden" name="product_id[]" value="${product_id}">${product}</td>
      <td><input type="hidden" name="cost_price[]" value="${costPrice}">${costPrice}</td>
      <td><input type="hidden" name="retail_price[]" value="${retailPrice}">${retailPrice}</td>
      <td><input type="hidden" name="quantity[]" value="${quantity}">${quantity}</td>
      <td><input type="hidden" name="location[]" value="${location}">${location}</td>
  </tr>`;

  // Append the new row to the table body
  $('#saved_purchase tbody').append(newRow);

  // Clear form fields
  $('#date').val('');
  $('#supplier_id').val('').trigger('change');
  $('#product_id').val('').trigger('change');;
  $('#cost_price').val('');
  $('#retail_price').val('');
  $('#quantity').val('');
  $('#location').val('');
}
