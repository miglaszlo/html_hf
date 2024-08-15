<?php
/*
    
    kijelentkezteti a felhasználót, és törli a session változókat

*/
session_start();

unset($_SESSION['username']);
unset($_SESSION['id']);
session_destroy();

header('Location: ../views/index.php');