"use strict";

(function () {
    // Init custom option check
    window.Helpers.initCustomOptionCheck();

    // Bootstrap validation example
    //------------------------------------------------------------------------------------------
    // const flatPickrEL = $('.flatpickr-validation');
    const flatPickrList = [].slice.call(
            document.querySelectorAll(".flatpickr-validation")
        ),
        selectPicker = $(".selectpicker");

    // Bootstrap Select
    // --------------------------------------------------------------------
    if (selectPicker.length) {
        selectPicker.selectpicker();
        handleBootstrapSelectEvents();
    }

    // Flat pickr
    if (flatPickrList) {
        flatPickrList.forEach((flatPickr) => {
            flatPickr.flatpickr({
                monthSelectorType: "static",
            });
        });
    }

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const bsValidationForms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.prototype.slice.call(bsValidationForms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // Submit your form
                    // alert("Submitted!!!");
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();
/**
 * Form Validation (https://formvalidation.io/guide/examples)
 * ? Primary form validation plugin for this template
 * ? In this example we've try to covered as many form inputs as we can.
 * ? Though If we've miss any 3rd party libraries, then refer: https://formvalidation.io/guide/examples/integrating-with-3rd-party-libraries
 */
//------------------------------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", function (e) {
    (function () {
        const formValidationExamples = document.getElementById(
            "formValidationExamples"
        );

        //? Revalidation third-party libs inputs on change trigger

        // Flatpickr
        const flatpickrDate = document.querySelector(
            '[name="formValidationDob"]'
        );

        if (flatpickrDate) {
            flatpickrDate.flatpickr({
                enableTime: false,
                // See https://flatpickr.js.org/formatting/
                dateFormat: "Y/m/d",
                // After selecting a date, we need to revalidate the field
                onChange: function () {
                    fv.revalidateField("formValidationDob");
                },
            });
        }
    })();
});
