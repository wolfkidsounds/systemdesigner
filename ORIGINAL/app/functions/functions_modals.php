<?php //functions_user.php

if (!defined("MODALPATH")) {
	define("MODALPATH", ABSPATH . "app/views/modals/");
}

class Func_Modals {
    public static function Racks($action, $rack_id) {
        if ($action == "new_slot") {
            ?>  
            <div class="modal active" data-rack="<?php out($rack_id); ?>" id="<?php out($rack_id); ?>">
            <a href="#close" class="modal-overlay close-modal" aria-label="Close"></a>
            <?php
            require_once MODALPATH . "racks/new_slot.php";
            ?> </div> <script src="/includes\assets\js\modal.js"></script> <?php
        }
    }

}