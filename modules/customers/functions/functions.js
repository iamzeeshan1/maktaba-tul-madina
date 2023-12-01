
function saveForm() {
    var formData = $('#custForm').serialize();
  
    $.ajax({
      type: 'POST',
      url: 'save.php', 
      data: formData,
      contentType: 'application/x-www-form-urlencoded',
      beforeSend: function() {
        $('#preloader').removeClass('d-none');
        $('#submit-btn').prop('disabled',true);
      },
      success: function(response) {
        var json = JSON.parse(response);
        $('#preloader').removeClass('d-none');
        setTimeout(function() {
           window.location.href='index.php';
           var toastType = json.status;
            var toastMsg = json.value;
            showToast(toastType, toastMsg);
          }, 2000);
      },
      complete: function() {
        $('#preloader').removeClass('d-none');
      }
    });
}
  