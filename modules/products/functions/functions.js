$("#misc_form").submit(function (e) {
  e.preventDefault();
  if (!this.checkValidity()) {
    return;
  }

  const formElement = document.getElementById("misc_form");
  var formData = new FormData(formElement);
  $.ajax({
    url: "ajax-calls.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data == "misc_error") {
        var toastType = "danger";
        var toastMsg = "Name already exists";
        showToast(toastType, toastMsg);
        return;
      } else {
        $("#miscModal").modal("hide");
        var toastType = "success";
        var toastMsg = "Added successfully";
        showToast(toastType, toastMsg);
        $("#misc_div").html("");
        $("#misc_div").html(data);
        $("#misc_id").select2({
          placeholder: "Choose one",
          searchInputPlaceholder: "Search",
          minimumResultsForSearch: Infinity,
          width: "100%",
        });
      }
    },
  });
});

function fn_category(category_id) {
  if (category_id == "3") {
    $("#language_div").addClass("d-none");
    $("#publisher_div").addClass("d-none");
    $("#misc_div").removeClass("d-none");
  } else {
    $("#language_div").removeClass("d-none");
    $("#publisher_div").removeClass("d-none");
    $("#misc_div").addClass("d-none");
  }
}
function fn_misc(misc_id) {
  if (misc_id == "other") {
    $("#miscModal").modal("toggle");
  }
}
function chech_prod_id(prod_id) {
  $('#product_id').parsley().removeError('customError', { updateClass: true });
  $.ajax({
    url: "ajax-calls.php",
    type: "POST",
    data: { prod_id: prod_id, "ACTION": 'chech_prod_id' },
    success: function (data) {
      if (data == '_error') {
        var $product_id = $('#product_id');
        $product_id.parsley().addError('customError', {
          message: 'Product ID alredy exist',
          updateClass: true
        });
      } else {
        $('#product_id').parsley().removeError('customError', { updateClass: true });
      }

    },
  });
}

function chech_prod_name(prod_name) {
  $('#product_name').parsley().removeError('customError', { updateClass: true });
  $.ajax({
    url: "ajax-calls.php",
    type: "POST",
    data: { prod_name: prod_name, "ACTION": 'chech_prod_name' },
    success: function (data) {
      if (data == '_error') {
        var $product_name = $('#product_name');
        $product_name.parsley().addError('customError', {
          message: 'Product Name alredy exist',
          updateClass: true
        });
      } else {
        $('#product_name').parsley().removeError('customError', { updateClass: true });
      }

    },
  });
}

function chech_prod_bar(prod_bar) {
  $('#barcode').parsley().removeError('customError', { updateClass: true });
  $.ajax({
    url: "ajax-calls.php",
    type: "POST",
    data: { prod_bar: prod_bar, "ACTION": 'chech_prod_bar' },
    success: function (data) {
      if (data == '_error') {
        var $barcode = $('#barcode');
        $barcode.parsley().addError('customError', {
          message: 'Product Barcode alredy exist',
          updateClass: true
        });
      } else {
        $('#barcode').parsley().removeError('customError', { updateClass: true });
      }

    },
  });
}
$(document).ready(function(){
  if(miscc_id > 0){
    $('#misc_div').removeClass("d-none");
    $("#language_div").addClass("d-none");
    $("#publisher_div").addClass("d-none");
  }else{
    $('#misc_div').addClass("d-none");
    $("#language_div").removeClass("d-none");
    $("#publisher_div").removeClass("d-none");
  }
});

