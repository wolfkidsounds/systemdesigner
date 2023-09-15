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
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Behringer</td>
            <td>DCX2496 Pro</td>
            <td>3</td>
            <td>6</td>
            <td>22</td>
            <td><a class="edit" href="/app/edit/processor/ID"><i class="fa-solid fa-pen"></i></a></td>
        </tr>
        <tr>
            <td>Behringer</td>
            <td>DCX2496 LE</td>
            <td>2</td>
            <td>6</td>
            <td>22</td>
            <td><a class="edit" href="/app/edit/processor/ID"><i class="fa-solid fa-pen"></i></a></td>
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