<script>
isSubmitting = false; 
function formSubmit(formId, responseDiv = '', modalDiv = '') {
    $('#'+formId).submit(function(e) {
        e.preventDefault();
        if (isSubmitting) {
            return;
        }

        if (!this.checkValidity()) {
            var invalidFeedbackElements = $(this).find('.invalid-feedback');
            invalidFeedbackElements.each(function() {
                $(this).show();
            });
        
            return;
        }

        $(this).find('.invalid-feedback').hide();
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
            if(formId == 'rack_form'){

                if(data == 'rack_error'){
                    var toastType = 'danger';
                    var toastMsg = 'Rack already exists';
                    showToast(toastType, toastMsg);
                    return;
                }
                
                $(modalDiv).modal("hide");
                var toastType = 'success';
                var toastMsg = 'Rack added successfully';
                showToast(toastType, toastMsg);

                $('#rack_id').html('');
                $('#rack_id').html(data);
            }
            if(formId == 'section_form'){

                if(data == 'section_error'){
                    var toastType = 'danger';
                    var toastMsg = 'section already exists';
                    showToast(toastType, toastMsg);
                    return;
                }

                $(modalDiv).modal("hide");
                var toastType = 'success';
                var toastMsg = 'section added successfully';
                showToast(toastType, toastMsg);

                $('#section_id').html('');
                $('#section_id').html(data);
            }
            if(formId == 'location_form'){

                if(data == 'location_error'){
                    var toastType = 'danger';
                    var toastMsg = 'Location already exists';
                    showToast(toastType, toastMsg);
                    return;
                }

                $(modalDiv).modal("hide");
                var toastType = 'success';
                var toastMsg = 'Location added successfully';
                showToast(toastType, toastMsg);

                $('#location_id').html('');
                $('#location_id').html(data);
            }
            if(formId == 'category_form'){

                if(data == 'category_error'){
                    var toastType = 'danger';
                    var toastMsg = 'Category already exists';
                    showToast(toastType, toastMsg);
                    return;
                }

                $(modalDiv).modal("hide");
                var toastType = 'success';
                var toastMsg = 'Category added successfully';
                showToast(toastType, toastMsg);

                $('#category_id').html('');
                $('#category_id').html(data);
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
function fn_section(section_id){
    if(section_id =="other") {
        $('#sectionModal').modal('toggle');
    }
}
function fn_location(location_id){
    if(location_id =="other") {
        $('#locationModal').modal('toggle');
    }
}
function fn_category(category_id){
    if(category_id =="other") {
        $('#categoryModal').modal('toggle');
    }
}

</script>