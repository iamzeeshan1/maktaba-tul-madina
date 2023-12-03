
isSubmitting = false; 
function formSubmit(formId, responseDiv = '', modalDiv = '') {
    $('#'+formId).submit(function(e) {
        e.preventDefault();
        if (isSubmitting) {
            return;
        }

        if (!this.checkValidity()) {
            return;
        }

        isSubmitting = true;
        const formElement = document.getElementById(formId);
        var formData = new FormData(formElement);
            //console.log(formData);
        $.ajax({
        url: 'ajax-calls.php',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
           
            if(formId == 'misc_form'){

                if(data == 'misc_error'){
                    var toastType = 'danger';
                    var toastMsg = 'Name already exists';
                    showToast(toastType, toastMsg);
                    return;
                }

                $(modalDiv).modal("hide");
                var toastType = 'success';
                var toastMsg = 'Added successfully';
                showToast(toastType, toastMsg);

                $('#misc_id').html('');
                $('#misc_id').html(data);
            }
        },
        complete: function() {
            isSubmitting = false; 
        },
        });
    });
}
function fn_rack(rack_id){
    if(rack_id =="other") {
        $('#rackModal').modal('toggle');
    }
}

function fn_category(category_id){
    if(category_id =="3") {
        $('#language_div').addClass('d-none');
        $('#publisher_div').addClass('d-none');
        $('#misc_div').removeClass('d-none');
    }else{
        $('#language_div').removeClass('d-none');
        $('#publisher_div').removeClass('d-none');
        $('#misc_div').addClass('d-none');
    }

}
function fn_misc(misc_id){
    if(misc_id =="other") {
        $('#miscModal').modal('toggle');
    }
}
