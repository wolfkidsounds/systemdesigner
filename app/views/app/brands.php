<link rel="stylesheet" href="/includes/assets/css/brands.css">
<?php //amplifier.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3>Brands</h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/brand">New Brand</a></li>
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
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
            <?php 
            
            $brands = Functions::getAllBrands();

            foreach ($brands as $brand) { ?>
                <tr>
                    <td><?php out($brand["brand_name"]); ?></td>
                    <td><a class="edit" href="/app/edit/brand/<?php out($brand["id"]); ?>"><i class="fa-solid fa-pen"></i></a></td>
                </tr>

            <?php } ?>
    </tbody>
    </table>
</div>

<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script>
    $('table').scrollTableBody();

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