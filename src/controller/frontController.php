<?php

class FrontController {
    public function __construct() {
        require("config/config.php");
        session_start();
    }

    public function appelController() {
        // $_SESSION['role']
    }
}

?>