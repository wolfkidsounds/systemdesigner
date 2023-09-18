<link rel="stylesheet" href="includes/assets/css/dsp.css">
<?php //dsp.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3>Processors (DSP)</h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/processor">New Processor</a></li>
    </ul>
</div>

<div class="toolbar-search">
    <ul>
        <li><input class="form-input table-custom-search" type="search" id="search_brand" placeholder="Search Brand..."></li>
    </ul>
</div>

<div class="table-custom">
    <table class="table">
    <thead>
        <tr>
            <th>Brand</th>
            <th>Model</th>
            <th>Inputs</th>
            <th>Outputs</th>
            <th>Offset</th>
            <th>Contributor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $processors = Functions::Processors()->getAllProcessors();
            foreach ($processors as $processor) { ?>
                <tr>
                    <td>
                        <?php
                            $brand_id = $processor["brand_id"];
                            $brand = Functions::Brands()->getBrand($brand_id);
                            $brand_name = $brand["brand_name"];
                            out($brand_name); 
                        ?>
                    </td>
                    <td><?php out($processor["model_name"]); ?></td>
                    <td><?php out($processor["inputs"]); ?></td>
                    <td><?php out($processor["outputs"]); ?></td>
                    <td><?php out($processor["offset"]); ?></td>
                    <td>
                        <?php
                            $user_id = $processor["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <a class="edit" href="/app/edit/processor/<?php out($processor["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                        <a class="del" href="/app/del/processor/<?php out($processor["id"]); ?>"><i class="fas fa-trash"></i></a>
                        <a class="download" href="/app/download/processor/<?php out($processor["id"]); ?>"><i class="fas fa-file-download"></i></a>
                    </td>
                </tr>

        <?php } ?>
    </tbody>
    </table>
</div>

<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("#search_brand").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<?php Partials::Close(); ?>