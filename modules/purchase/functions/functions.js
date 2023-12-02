function formSubmit() {
  var form = $("#purchase_form")[0];
  if (!form.checkValidity()) {
    return;
  }
  var formData = $("#purchase_form").serialize();

  $.ajax({
    type: "POST",
    url: "save.php",
    data: formData,
    beforeSend: function () {
      $("#preloader").removeClass("d-none");
      $("#submit-btn").prop("disabled", true);
    },
    success: function (response) {
      var json = JSON.parse(response);
      $("#preloader").removeClass("d-none");
      setTimeout(function () {
        window.location.href = "index.php";
        var toastType = json.status;
        var toastMsg = json.value;
        showToast(toastType, toastMsg);
      }, 2000);
    },
    complete: function () {
      $("#preloader").removeClass("d-none");
    },
  });
}

function add_purchase(purchase_id) {
  $.ajax({
    type: "POST",
    url: "ajax_calls.php",
    data: { ACTION: "purchase", purchase_id: purchase_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#purchase_id").val(purchase_id);
      $("#supplier_id").val(json.supplier_id);
      $("#date").val(json.date);
      $("#cost_price").val(json.cost_price);
      $("#retail_price").val(json.retail_price);
      $("#quantity").val(json.quantity);
      $("#location").val(json.location);
      $("#purchase_Modal").modal("toggle");
    },
  });
}