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
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>the t.amp</td>
            <td>Quadro 500 DSP</td>
            <td>4</td>
            <td>250 Watt</td>
            <td>500 Watt</td>
            <td>0 Watt</td>
            <td><a class="edit" href="/app/amplifiers/edit/ID"><i class="fa-solid fa-pen"></i></a></td>
        </tr>
        <tr>
            <td>Fame</td>
            <td>MS 5004</td>
            <td>2</td>
            <td>350 Watt</td>
            <td>520 Watt</td>
            <td>0 Watt</td>
            <td><a class="edit" href="/app/amplifiers/edit/ID"><i class="fa-solid fa-pen"></i></a></td>
        </tr>
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