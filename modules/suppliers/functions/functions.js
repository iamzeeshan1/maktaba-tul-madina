function formSubmit() {
  var form = $("#supplier_form")[0];
  if (!form.checkValidity()) {
    return;
  }

  var formData = new FormData(form);
  var content = tinymce.get("details").getContent();
  formData.append("details", content);

  $.ajax({
    type: "POST",
    url: "save.php",
    data: formData,
    contentType: false,
    processData: false,
    beforeSend: function () {
      $("#preloader").removeClass("d-none");
      $("#submit-btn").prop("disabled", true);
    },
    success: function (response) {
      var json = JSON.parse(response);

      $("#preloader").removeClass("d-none");

      setTimeout(function () {
        if (json.status == "danger") {
          var toastType = json.status;
          var toastMsg = json.value;
          showToast(toastType, toastMsg);
          // $('#preloader').addClass('d-none');
          // $('#submit-btn').prop('disabled',false);
        } else {
          var toastType = json.status;
          var toastMsg = json.value;
          showToast(toastType, toastMsg);
          $("#supplier_Modal").modal("toggle");
          loadTable();

          $("#supplier_form")
            .find(".parsley-success")
            .removeClass("parsley-success");
          $("#supplier_form")
            .find(".parsley-error")
            .removeClass("parsley-error");
        }
      }, 2000);
    },
    complete: function () {
      $("#preloader").removeClass("d-none");
    },
  });
}

function add_supplier(supplier_id) {
  $.ajax({
    type: "POST",
    url: "ajax_calls.php",
    data: { ACTION: "supplier", supplier_id: supplier_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#supplier_id").val(supplier_id);
      $("#supplier_name").val(json.supplier_name);
      $("#email").val(json.email);
      $("#address").val(json.address);
      $("#contact_number").val(json.contact_number);
      tinymce.get("details").setContent(json.details);
      $("#supplier_Modal").modal("toggle");
    },
  });
}

loadTable();
function loadTable() {
  $("#loadTable").load("loadTable.php", function () {});
}
