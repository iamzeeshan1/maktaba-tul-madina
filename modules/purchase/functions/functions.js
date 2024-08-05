function editFormSubmit(event) {
  event.preventDefault();
  var form = $('#edit_purchase_form').parsley();
  form.validate();//parsely validation

  if (form.isValid()) {
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
}

function formSubmit() {
  var allRows = [];
  var notes = $('#notes').val();
  // Loop through each table row
  $('#saved_purchase_table tbody tr').each(function (index, row) {
    var rowData = {
      date: $(row).find('td:eq(0) input').val(),
      inv_num: $(row).find('td:eq(1) input').val(),
      doc_num: $(row).find('td:eq(2) input').val(),
      supplier_id: $(row).find('td:eq(3) input').val(),
      product_id: $(row).find('td:eq(4) input').val(),
      location: $(row).find('td:eq(5) input').val(),
      quantity: $(row).find('td:eq(6) input').val(),
      cost_price: $(row).find('td:eq(7) input').val(),
      retail_price: $(row).find('td:eq(8) input').val()
    };

    allRows.push(rowData);
  });

  $.ajax({
    url: 'save.php',
    method: 'POST',
    data: { allRows: allRows, notes: notes, 'ACTION': 'save' },
    beforeSend: function () {
      $(".preloader").removeClass("d-none");
      $(".submit-btn").prop("disabled", true);
    },
    success: function (response) {
      var json = JSON.parse(response);

      $(".preloader").removeClass("d-none");
      window.location.href = 'index.php';
      var toastType = json.status;
      var toastMsg = json.value;
      showToast(toastType, toastMsg);


    },
    complete: function () {
      $(".preloader").removeClass("d-none");
      $(".submit-btn").prop("disabled", true);
    },
  });

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
      $("#item_idd").val(json.item_id).trigger('change');
      $("#datee").val(json.date);
      $("#cost_pricee").val(json.cost_price);
      $("#retail_pricee").val(json.retail_price);
      $("#quantityy").val(json.quantity);
      $("#doc_num").val(json.doc_num);
      $("#location_id").val(json.location).trigger('change');

      clearFormValidation("#edit_purchase_form");

      $("#edit_purchase_Modal").modal("toggle");
    },
  });
}

function edit_data(event) {
  event.preventDefault();

  $('.div-data').toggleClass('d-none', false);
  $('.submit-btn').toggleClass('d-none', false);

  var row_id = $('#row_idd').val();
  var inv_num = $('#inv_number').val();
  var date = $('#datee').val();
  var supplier = $('#supplier_idd option:selected').text();
  var supplier_id = $('#supplier_idd').val();
  var product_id = $('#item_idd').val();
  var product = $('#item_idd option:selected').text();
  var costPrice = $('#cost_pricee').val();
  var retailPrice = $('#retail_pricee').val();
  var quantity = $('#quantityy').val();
  var loc_id = $('#location_id').val();
  var location = $('#location_id option:selected').text();
  var doc_num = $('#doc_number').val();
  // Split multiple locations into an array
  // Create a table row and append data

  let uniqueRowId = row_id;

  var newRow = `<tr  data-row-id="${uniqueRowId}">
           <td><input type="hidden" name="date[]" value="${date}">${date}</td>
           <td><input type="hidden" name="invoice_num[]" value="${inv_num}">${inv_num}</td>
           <td><input type="hidden" name="doc_num[]" value="${doc_num}">${doc_num}</td>
           <td><input type="hidden" name="supplier_id[]" value="${supplier_id}">${supplier}</td>
           <td><input type="hidden" name="product_id[]" value="${product_id}">${product}</td>
           <td><input type="hidden" name="location[]" value="${loc_id}">${location}</td>
           <td><input type="hidden" name="quantity[]" value="${quantity}">${quantity}</td>
           <td><input type="hidden" name="cost_price[]" value="${costPrice}">${costPrice}</td>
           <td><input type="hidden" name="retail_price[]" value="${retailPrice}">${retailPrice}</td>
           <td><i class="fa fa-edit edit-row" onclick="editRow('${uniqueRowId}')"></i></td>
       </tr>`;

  // Append the new row to the table body
  $(`[data-row-id="${row_id}"]`).replaceWith(newRow);

  $("#edit_purchase_Modal").modal("toggle");
  $("#purchase_form")[0].reset();
  $("#row_id").val('0');
  clearFormValidation("#purchase_form");
  $('#supplier_id').val(supplier_id).trigger('change');
  $('#date').val(date);
  $('#inv_num').val(inv_num);
  $('#doc_num').val(doc_num);
  $('#saved_purchase_table')[0].scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });

  var tc = sum_cost_price();
  $('#set_tfoot_cost_value').html(tc);

  var tretail = sum_retail_price();
  $('#set_tfoot_retail_value').html(tretail);

}



let rowCounter = 0;
function save_data(event) {
  event.preventDefault();
  var form = $('#purchase_form').parsley();
  form.validate();//parsely validation

  if (form.isValid()) {
    $('.div-data').toggleClass('d-none', false);
    $('.submit-btn').toggleClass('d-none', false);

    var row_id = $('#row_id').val();
    var inv_num = $('#inv_num').val();
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
    var doc_num = $('#doc_num').val();
    // Split multiple locations into an array
    // Create a table row and append data
    let uniqueRowId = 'row-' + rowCounter++;
    var newRow = `<tr  data-row-id="${uniqueRowId}">
           <td><input type="hidden" name="date[]" value="${date}">${date}</td>
           <td><input type="hidden" name="invoice_num[]" value="${inv_num}">${inv_num}</td>
           <td><input type="hidden" name="doc_num[]" value="${doc_num}">${doc_num}</td>
           <td><input type="hidden" name="supplier_id[]" value="${supplier_id}">${supplier}</td>
           <td><input type="hidden" name="product_id[]" value="${product_id}">${product}</td>
           <td><input type="hidden" name="location[]" value="${loc_id}">${location}</td>
           <td><input type="hidden" name="quantity[]" value="${quantity}">${quantity}</td>
           <td><input type="hidden" name="cost_price[]" value="${costPrice}">${costPrice}</td>
           <td><input type="hidden" name="retail_price[]" value="${retailPrice}">${retailPrice}</td>
           <td><i class="fa fa-edit edit-row" onclick="editRow('${uniqueRowId}')"></i></td>
       </tr>`;

    // Append the new row to the table body
    $('#saved_purchase_table tbody').append(newRow);

    $("#purchase_form")[0].reset();
    $("#row_id").val('0');
    clearFormValidation("#purchase_form");
    $('#supplier_id').val(supplier_id).trigger('change');
    $('#date').val(date);
    $('#inv_num').val(inv_num);
    $('#doc_num').val(doc_num);

    $('#saved_purchase_table')[0].scrollIntoView({ behavior: "smooth", block: "nearest", inline: "start" });
    var tc = sum_cost_price();
    $('#set_tfoot_cost_value').html(tc);

    var tretail = sum_retail_price();
    $('#set_tfoot_retail_value').html(tretail);
  }

}

function sum_cost_price() {
  var total_costt = 0;
  $('#saved_purchase_table tbody tr').each(function (index, row) {
    var cost_price = parseFloat($(row).find('td:eq(7) input').val()) || 0;
    total_costt += cost_price;
  });
  return total_costt;
}

function sum_retail_price() {
  var total_retaill = 0;
  $('#saved_purchase_table tbody tr').each(function (index, row) {
    var retail_price = parseFloat($(row).find('td:eq(8) input').val()) || 0;
    total_retaill += retail_price;
  });
  return total_retaill;
}
function editRow(rowId) {
  var $row = $(`[data-row-id="${rowId}"]`);
  var date = $row.find('input[name="date[]"]').val();
  var invoice_num = $row.find('input[name="invoice_num[]"]').val();
  var doc_num = $row.find('input[name="doc_num[]"]').val();
  var supplier_id = $row.find('input[name="supplier_id[]"]').val();
  var product_id = $row.find('input[name="product_id[]"]').val();
  var loc_id = $row.find('input[name="location[]"]').val();
  var quantity = $row.find('input[name="quantity[]"]').val();
  var costPrice = $row.find('input[name="cost_price[]"]').val();
  var retailPrice = $row.find('input[name="retail_price[]"]').val();

  $('#datee').val(date);
  $('#inv_number').val(invoice_num);
  $('#doc_number').val(doc_num);
  $('#doc_number').prop('readonly', true);
  $('#supplier_idd').val(supplier_id).trigger('change');;
  $('#item_idd').val(product_id).trigger('change');;
  $('#location_id').val(loc_id);
  $('#quantityy').val(quantity);
  $('#cost_pricee').val(costPrice);
  $('#retail_pricee').val(retailPrice);
  $('#row_idd').val(rowId);
  $("#edit_purchase_Modal").modal("toggle");
}

loadInvTable();
function loadInvTable() {
  var inv = $('#loadInvTable').data('id');
  var admin_r = admin_req;
  $("#loadInvTable").load("loadInvTable.php", { inv: inv,admin_r:admin_r }, function () { });
}
function add_location(loc_id) {
  if (loc_id == "other") {
    $('#loc_form').trigger('reset');
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
        $(".double-loc").html("");
        $(".double-loc").html(data);
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

function show_inv() {
  $("#invModal").modal("toggle");
}
function printModal() {
  const printContents = document.getElementById('invModal').innerHTML;
  const originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}
function get_details(product_id) {
  $.ajax({
    type: "POST",
    url: "ajax_calls.php",
    data: { ACTION: "get_details", product_id: product_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#cost_price").val(json.cost_price);
      $("#retail_price").val(json.retail_price);
      $("#loc_idd").val(json.location);
    },
  });
}
function reset_filter() {
  window.location.href = 'index.php';
}
function request_edit(inv_num) {
  Swal.fire({
    title: 'Confirmation',
    text: "Are you sure you want to send Edit request?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-4',
    cancelButtonClass: 'btn btn-danger w-xs mt-2',
    confirmButtonText: 'Yes',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "ajax_calls.php",
        data: { ACTION: "user_request_edit", inv_num: inv_num },
        beforeSend: function () {
          var toastType = 'success';
          var toastMsg = 'Request Sent';
          showToast(toastType, toastMsg);
        },
        success: function (response) {
          $('#btn-req-'+inv_num).hide();
        },
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
    }
  });
}
function editInvRow(purchaseId) {
  const row = document.getElementById(`row-${purchaseId}`);
  const cells = row.getElementsByTagName('td');
  const quantity = cells[3].innerText;
  const retailPrice = cells[4].innerText;
  const costPrice = cells[5].innerText;

  cells[3].innerHTML = `<input type="text" class="form-control" value="${quantity}" id="quantity-${purchaseId}">`;
  cells[4].innerHTML = `<input type="text" class="form-control" value="${retailPrice}" id="retail-price-${purchaseId}">`;
  cells[5].innerHTML = `<input type="text" class="form-control" value="${costPrice}" id="cost-price-${purchaseId}">`;
  cells[6].innerHTML = `<i  class="fa fa-check text-success" onclick="saveRow(${purchaseId})"></i>
                        <i class="fa fa-times text-danger" onclick="cancelEdit()"></i>`;
}
function saveRow(purchaseId) {
  const costNewValue = $(`#cost-price-${purchaseId}`).val();
  const retailNewValue = $(`#retail-price-${purchaseId}`).val();
  const quantityNewValue = $(`#quantity-${purchaseId}`).val();

  if (costNewValue == '' || retailNewValue == '' || quantityNewValue == '') {
    var toastType = 'danger';
    var toastMsg = 'Please fill all values';
    showToast(toastType, toastMsg);
    return;
  }

  Swal.fire({
    title: 'Confirmation',
    text: "Are you sure you want to save the changes?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-4',
    cancelButtonClass: 'btn btn-danger w-xs mt-2',
    confirmButtonText: 'Yes',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "ajax_calls.php",
        data: { ACTION: "save_invoice_changes", p_id: purchaseId, 'cost': costNewValue, 'retail': retailNewValue, 'quantity': quantityNewValue },
        success: function (response) {
          var toastType = 'success';
          var toastMsg = 'Data Saved Successfully!';
          showToast(toastType, toastMsg);

          loadInvTable();
        },
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      cancelEdit();
    }
  });
}

function cancelEdit() {
  loadInvTable();
}
$(document).ready(function () {
    
  if (admin_req == 1) {
    $('.edit_row').show();
  } else {
    $('.edit_row').hide();
  }
});

function printPage() {
  $('.edit_row').hide();
  window.print();
  setTimeout(function () {
    $('.edit_row').show();
  }, 1000);
}