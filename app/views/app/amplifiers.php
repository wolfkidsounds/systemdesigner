<link rel="stylesheet" href="/includes/assets/css/amplifiers.css">
<?php //amplifier.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3>Amplifiers</h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/amplifier">New Amplifier</a></li>
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
            <th>Channels</th>
            <th>Power @ 8Ω</th>
            <th>Power @ 4Ω</th>
            <th>Power @ 2Ω</th>
            <th>Power Bridge @ 8Ω</th>
            <th>Power Bridge @ 4Ω</th>
            <th>Contributors</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            
            $amplifiers = Functions::Amplifiers()->getAllAmplifiers();

            foreach ($amplifiers as $amplifier) { ?>
                <tr>
                    <td>
                        <?php
                            $brand_id = $amplifier["amp_brand"];
                            $brand = Functions::Brands()->getBrand($brand_id);
                            $brand_name = $brand["brand_name"];
                            out($brand_name); 
                        ?>
                    </td>
                    <td><?php out($amplifier["amp_model"]); ?></td>
                    <td><?php out($amplifier["amp_ch"]); ?></td>
                    <td><?php out($amplifier["amp_power_8"]); ?></td>
                    <td><?php out($amplifier["amp_power_4"]); ?></td>
                    <td><?php out($amplifier["amp_power_2"]); ?></td>
                    <td><?php out($amplifier["amp_power_bridge_8"]); ?></td>
                    <td><?php out($amplifier["amp_power_bridge_4"]); ?></td>
                    <td>
                        <?php
                            $user_id = $amplifier["user_id"];
                            $user = Functions::Users()->getUser($user_id);
                            $user_name = $user["user_name"];
                            out($user_name); 
                        ?>
                    </td>
                    <td>
                        <a class="edit" href="/app/amplifiers/edit/<?php out($amplifier["id"]); ?>"><i class="fa-solid fa-pen"></i></a>
                        <a class="del" href="/app/amplifiers/del/<?php out($amplifier["id"]); ?>"><i class="fas fa-trash"></i></a>
                        <a class="download" href="/app/amplifiers/download/<?php out($amplifier["id"]); ?>"><i class="fas fa-file-download"></i></a>
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