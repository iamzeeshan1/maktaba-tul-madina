function formSubmit() {
  var form = $("#language_form")[0];
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
          $("#language_Modal").modal("toggle");
          loadTable();
        }
      }, 2000);
    },
    complete: function () {
      $(".preloader").removeClass("d-none");
    },
  });
}

function add_language(language_id) {
  $.ajax({
    type: "POST",
    url: "ajax_calls.php",
    data: { ACTION: "language", language_id: language_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#language_id").val(language_id);
      $("#lan_name").val(json.lan_name);
      
      clearFormValidation("#language_form");
      $("#language_Modal").modal("toggle");
    },
  });
}

loadTable();
function loadTable() {
  $("#loadTable").load("loadTable.php", function () {
    $('#Suptable').DataTable({
      responsive: true,
      language: {
         searchPlaceholder: 'Search...',
         sSearch: '',
         lengthMenu: '_MENU_ items/page',
      }
   });
  });
}
