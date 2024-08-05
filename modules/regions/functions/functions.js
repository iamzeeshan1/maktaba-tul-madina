function formSubmit() {
  var form = $("#region_form")[0];
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
          $("#region_Modal").modal("toggle");
          loadTable();
        }
      }, 2000);
    },
    complete: function () {
      $(".preloader").removeClass("d-none");
    },
  });
}

function add_region(region_id) {
  $.ajax({
    type: "POST",
    url: "ajax_calls.php",
    data: { ACTION: "region", region_id: region_id },
    success: function (response) {
      var json = JSON.parse(response);
      $("#region_id").val(region_id);
      $("#region_name").val(json.region_name);
      
      clearFormValidation("#region_form");
      $("#region_Modal").modal("toggle");
    },
  });
}

loadTable();
function loadTable() {
  $("#loadTable").load("loadTable.php", function () {
    $('#regiontable').DataTable({
      responsive: true,
      language: {
         searchPlaceholder: 'Search...',
         sSearch: '',
         lengthMenu: '_MENU_ items/page',
      }
   });
  });
}
