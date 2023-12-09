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
