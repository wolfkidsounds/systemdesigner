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
    <div class="dropdown">
        <a class="btn btn-link btn-primary dropdown-toggle dropdown-right" tabindex="0">
          <?php out($_SESSION['user_name']) ?> 
          <i class="fa-solid fa-caret-down" style="color: #ffffff;"></i>
        </a>
        <ul class="menu">
          <li class="menu-item"><a href="/user/account"><?php Translator::translate("navigation.account") ?></a></li>
          <li class="menu-item"><a href="/user/settings"><?php Translator::translate("navigation.settings") ?></a></li>
          <li class="menu-item"><a href="/app/version"><?php Translator::translate("app.version") ?></a></li>
          <li class="menu-item"><a href="/logout"><?php Translator::translate("navigation.logout") ?></a></li>
        </ul>
    </div>
    <?php } ?>
  </section>
</header>