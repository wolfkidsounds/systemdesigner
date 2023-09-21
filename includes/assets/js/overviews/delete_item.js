function deleteItem(itemID) {
    // Add the "loading" class to the button
    const row = $(`tr[data-id="${itemID}"]`);
    row.addClass("loading");
  
    // Send an AJAX request
    $.ajax({
        type: "POST",
        url: `/app/del/processor/${itemID}`,
        success: function (response) {
            $(`tr[data-id="${itemID}"]`).removeClass("loading");
            $(`tr[data-id="${itemID}"]`).remove();
            toasts.push({
                title: '<?php Translator::translate("toast.success"); ?>',
                content: '<?php Translator::translate("toast.delete.success"); ?>',
                style: 'success'
            });
        },
        complete: function () {
            $(`tr[data-id="${itemID}"]`).removeClass("loading");
        },
    });
}