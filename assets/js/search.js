$('#search-input').on('input', function() {
    var searchText = $(this).val().toLowerCase();
    $('#search-table tr').each(function() {
        var rowText = $(this).text().toLowerCase();
        if (rowText.includes(searchText)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});