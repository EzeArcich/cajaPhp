<?php
// logout.php

require_once 'controllers/authController.php';
$authController = new AuthController($db);
$authController->logout();
?>