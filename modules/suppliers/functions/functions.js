
function formSubmit() {
  var formData = new FormData(document.getElementById('supplier_form'));
  var content = tinymce.get('details').getContent();
  formData.append('details', content);
  
  $.ajax({
    type: 'POST',
    url: 'save.php', 
    data: formData,
    contentType: false,  
    processData: false,
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

function add_supplier(supplier_id){
  $.ajax({
    type: 'POST',
    url: 'ajax_calls.php', 
    data: {'ACTION':'supplier','supplier_id':supplier_id},
    success: function(response) {
      var json = JSON.parse(response);
      $('#supplier_id').val(supplier_id);
      $('#supplier_name').val(json.supplier_name);
      $('#email').val(json.email);
      $('#address').val(json.address);
      $('#contact_number').val(json.contact_number);
      tinymce.get('details').setContent(json.details);
      $('#supplier_Modal').modal('toggle');
    }
  });
  $
}