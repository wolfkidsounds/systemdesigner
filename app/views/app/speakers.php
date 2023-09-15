<link rel="stylesheet" href="includes/assets/css/speaker.css">
<?php //speaker.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<h3>Speakers (Cabinets)</h3>

<div class="toolbar">
    <ul>
        <li><a href="/app/new/speaker">New Speaker</a></li>
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
            <th>AES/RMS Power (W)</th>
            <th>Z nom. (Ω)</th>
            <th>Vrms (V)</th>
            <th>Sensitivity 1W @ 1m (dB SPL)</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Carvin</td>
            <td>1331</td>
            <td>500</td>
            <td>8</td>
            <td>63,2</td>
            <td>105</td>
            <td><a class="edit" href="/app/amplifiers/edit/ID"><i class="fa-solid fa-pen"></i></a></td>
        </tr>
        <tr>
            <td>Carvin</td>
            <td>2470-R520</td>
            <td>90</td>
            <td>8</td>
            <td>26,8</td>
            <td>105</td>
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