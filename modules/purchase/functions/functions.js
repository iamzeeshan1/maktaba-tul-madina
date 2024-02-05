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
  if (!$('#saved_purchase').hasClass('d-none')) {
    $('#saved_purchase').addClass('d-none');
    $('#submit-btn').addClass('d-none');
  }
  $("#purchase_Modal").modal("toggle");
  $("#purchase_form")[0].reset();
  clearFormValidation("#purchase_form");

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
      $("#location_id").val(json.location).trigger('change');

      clearFormValidation("#edit_purchase_form");

      $("#edit_purchase_Modal").modal("toggle");
    },
  });
}
loadTable();
function loadTable() {
  $("#loadTable").load("loadTable.php", function () {
    $('#purTable').DataTable({
      responsive: true,
      language: {
         searchPlaceholder: 'Search...',
         sSearch: '',
         lengthMenu: '_MENU_ items/page',
      }
   });
  });
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
  var loc_id = $('#loc_idd').val(); 
  var location = $('#loc_idd option:selected').text();
  // Split multiple locations into an array
  // Create a table row and append data
  var newRow = `<tr>
      <td><input type="hidden" name="date[]" value="${date}">${date}</td>
      <td><input type="hidden" name="supplier_id[]" value="${supplier_id}">${supplier}</td>
      <td><input type="hidden" name="product_id[]" value="${product_id}">${product}</td>
      <td><input type="hidden" name="cost_price[]" value="${costPrice}">${costPrice}</td>
      <td><input type="hidden" name="retail_price[]" value="${retailPrice}">${retailPrice}</td>
      <td><input type="hidden" name="quantity[]" value="${quantity}">${quantity}</td>
      <td><input type="hidden" name="location[]" value="${loc_id}">${location}</td>
  </tr>`;

  // Append the new row to the table body
  $('#saved_purchase tbody').append(newRow);

  // Clear form fields
  // $('#date').val('');
  // $('#supplier_id').val('').trigger('change');
  // $('#product_id').val('').trigger('change');
  // $('#cost_price').val('');
  // $('#retail_price').val('');
  // $('#quantity').val('');
  // $('#loc_idd').val('').trigger('change');
  $("#purchase_form")[0].reset();
}

function EditCost(element) {
  var purchaseId = $(element).data('purchase-id');
  var costPrice = $(element).text();
  
  $(element).html('<input type="text" id="editableCostPrice" value="' + costPrice + '">');

  // Focus on the input field
  $('#editableCostPrice').focus();

  // Save the edited value on focusout
  $('#editableCostPrice').on('focusout', function() {
      var newCostPrice = $(this).val();

      $.ajax({
          url: 'save.php', 
          method: 'POST',
          data: { ACTION:"update_cost_price",purchase_id: purchaseId, cost_price: newCostPrice },
          success: function(response) {
              $(element).text(newCostPrice);
              loadInvTable();
          }
      });

  });
}
function EditRetail(element) {
  var purchaseId = $(element).data('purchase-id');
  var retailPrice = $(element).text();
  
  $(element).html('<input type="text" id="editRetaiil" value="' + retailPrice + '">');

  // Focus on the input field
  $('#editRetaiil').focus();

  // Save the edited value on focusout
  $('#editRetaiil').on('focusout', function() {
      var newretailPrice = $(this).val();

      $.ajax({
          url: 'save.php', 
          method: 'POST',
          data: { ACTION:"update_retail_price",purchase_id: purchaseId, retail_price: newretailPrice },
          success: function(response) {
              $(element).text(newretailPrice);
              
          }
      });

  });
}
function EditQnty(element) {
  var purchaseId = $(element).data('purchase-id');
  var qnty = $(element).text();
  
  $(element).html('<input type="text" id="editQnty" value="' + qnty + '">');

  // Focus on the input field
  $('#editQnty').focus();

  // Save the edited value on focusout
  $('#editQnty').on('focusout', function() {
      var newqnty = $(this).val();

      $.ajax({
          url: 'save.php', 
          method: 'POST',
          data: { ACTION:"update_retail_price",purchase_id: purchaseId, quantity: newqnty },
          success: function(response) {
              $(element).text(newqnty);
              
          }
      });

  });
}
loadInvTable();
function loadInvTable() {
  var inv = $('#loadInvTable').data('id');
  $("#loadInvTable").load("loadInvTable.php", {inv:inv},function () {});
}
function add_location(loc_id) {
  if (loc_id == "other") {
    $("#locModal").modal("toggle");
  }
}
$("#loc_form").submit(function (e) {
  e.preventDefault();
  if (!this.checkValidity()) {
    return;
  }

  const formElement = document.getElementById("loc_form");
  var formData = new FormData(formElement);
  $.ajax({
    url: "ajax_calls.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data == "loc_error") {
        var toastType = "danger";
        var toastMsg = "Location already exists";
        showToast(toastType, toastMsg);
        return;
      } else {
        $("#locModal").modal("hide");
        var toastType = "success";
        var toastMsg = "Added successfully";
        showToast(toastType, toastMsg);
        $("#loc_id").html("");
        $("#loc_id").html(data);
        // $("#misc_id").select2({
        //   placeholder: "Choose one",
        //   searchInputPlaceholder: "Search",
        //   minimumResultsForSearch: Infinity,
        //   width: "100%",
        // });
      }
    },
  });
});
