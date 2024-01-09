function formSubmit() {
  var form = $("#picklist_form")[0];
  if (!form.checkValidity()) {
    return;
  }

  var formData = new FormData(form);

  $.ajax({
    type: "POST",
    url: "save.php",
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
          loadTable();
        }
      }, 2000);
    },
    complete: function () {
      $(".preloader").removeClass("d-none");
    },
  });
}

function add_person(picklist_id) {
  $.ajax({
    type: "POST",
    url: "ajax_calls.php",
    data: { ACTION: "picklist", picklist_id: picklist_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#picklist_id").val(picklist_id);
      $("#name").val(json.name);
      
      clearFormValidation("#picklist_form");
      $("#picklist_Modal").modal("toggle");
    },
  });
}

loadTable();
function loadTable() {
  $("#loadTable").load("loadTable.php", function () {});
}
