<link rel="stylesheet" href="/includes/assets/css/amplifiers.css">
<?php //amplifier.php

// session_start();
// require_once ABSPATH . "/app/functions.php";
// if (!Functions::CheckUserLoggedIn()) {
//     header("Location: /");
//     exit();
// }

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);
?>

<div class="table-custom">
    <h3>Amplifiers</h3>
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

<?php Partials::Close(); ?>