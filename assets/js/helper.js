function clearFormValidation(formId){
     //preloader
     $(".preloader").addClass("d-none");
     $(".submit-btn").prop("disabled", false);
     //validation
     // $(formId).trigger("reset");
     $(formId).find(".parsley-success").removeClass("parsley-success");
     $(formId).find(".parsley-error").removeClass("parsley-error");
     //To remove validation messages like "this value is required"
     Parsley.addMessages('en', {defaultMessage: "",required:""});
}