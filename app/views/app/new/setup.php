<link rel="stylesheet" href="/includes/assets/css/new_item.css">
<link rel="stylesheet" href="/includes/assets/css/rack.css">
<script src="/node_modules\jquery\dist\jquery.min.js"></script>

<?php //new/amplifer.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

?>
<style>
        .editable:hover {
            border: 1px dashed #ccc;
            cursor: pointer;
        }
</style>
<div class="toolbar">
    <ul>
        <li><button class="btn" id="new-rack">New Rack</button></li>
    </ul>
</div>

<hr>

<div id="rack-container"></div>
<script>
    $(document).ready(function () {
        let rackCount = 1; // Initialize the rack count
        const rackContainer = $("#rack-container");

        $("#new-rack").on("click", function newRack(e) {
            e.preventDefault(); // Prevent the link from navigating

            // Create a new rack div
            const newRack = $(`
                <div id="rack_${rackCount}" class="rack">
                    <div class="rack-name editable" data-rack="rack_${rackCount}"><p>Rack ${rackCount}</p></div>
                    <div class="rack-slot">
                        <button class="btn new-slot-item" data-rack="rack_${rackCount}">Empty Slot</button>
                    </div>
                </div>
            `);

            // Append the new rack to the container
            rackContainer.append(newRack);

            // Increment the rack count for the next rack
            rackCount++;
        });

        rackContainer.on("click", ".new-slot-item", function () {
            const rack_id = $(this).data("rack"); // Retrieve the data-rack attribute
            const newItemButton = $(".new-slot-item");
            
            newItemButton.addClass("loading");
            openDialog(rack_id, newItemButton);
        });

        function openDialog(rack_id, newItemButton) {
            $.ajax({
                url: '/app/modal/open/rack/new_slot/' + rack_id,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    newItemButton.removeClass("loading");
                    // Update the content of the #modal-wrapper with the response
                    $('#modal-wrapper').html(response);
                
                },
                error: function(xhr, status, error) {
                    newItemButton.removeClass("loading");
                    // Handle any errors here
                    console.error(error);
                }
            });
        }
    });
</script>

<?php 
Partials::Close();
?>