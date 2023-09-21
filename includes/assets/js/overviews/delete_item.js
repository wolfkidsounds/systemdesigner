function deleteItem(itemType, itemID) {
    // Add the "loading" class to the button
    const row = $(`tr[data-id="${itemID}"]`);
    row.addClass("loading");
  
    // Send an AJAX request
    $.ajax({
        type: "POST",
        url: `/app/del/${itemType}/${itemID}`,
        success: function (response) {
            $(`tr[data-id="${itemID}"]`).removeClass("loading");
            $(`tr[data-id="${itemID}"]`).remove();
            toasts.push({
                title: 'Success',
                content: '',
                style: 'success'
            });
        },
        error: function (response) {
            $(`tr[data-id="${itemID}"]`).removeClass("loading");
            toasts.push({
                title: 'Error',
                content: '',
                style: 'error'
            });

        },
        complete: function () {
            $(`tr[data-id="${itemID}"]`).removeClass("loading");
        },
    });
}