<?php //partials.php
class ViewPartials {
    public function OpenHTML() {
        require_once __DIR__ . "/partials/open_html.php";
    }
    public function Styles() {
        require_once __DIR__ . "/partials/styles.php";        
    }
    public function Navigation() {
        require_once __DIR__ . "/partials/navigation.php";
    }
    public function Sidebar() {
        require_once __DIR__ . "/partials/sidebar.php";
    }
    public function Header() {
        require_once __DIR__ . "/partials/header.php";        
    }
    public function Footer() {
        require_once __DIR__ . "/partials/footer.php";         
    }
    public function Scripts() {
        require_once __DIR__ . "/partials/scripts.php";        
    }
    public function CloseHTML() {
        require_once __DIR__ . "/partials/close_html.php"; 
    }
}