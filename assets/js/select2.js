// Retrieve the placeholder attribute from the select element
var placeholder = $('select[data-select="true"]').attr('placeholder');

// Initialize select2 with the retrieved placeholder
$('select[data-select="true"]').select2({
    theme: "bootstrap-5",
    placeholder: placeholder // Use the retrieved placeholder
});