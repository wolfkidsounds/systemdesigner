<link rel="stylesheet" href="/includes/assets/css/navigation.css">
<?php //navigation.php ?>

<header class="navbar">
  <section class="navbar-section">
    <h5>Pulsation Audio - Designer</h5>
  </section>
  <section class="navbar-section">
    <?php

    require_once ABSPATH . "app/functions/functions.php";    
    if (Functions::Users()->checkLogin()) { ?>

    <a class="nav-account" href="/user/account" class="btn btn-link"><i class="fas fa-user"></i><?php out($_SESSION['user_name']) ?></a>
      
    <?php } ?>
  </section>
</header>