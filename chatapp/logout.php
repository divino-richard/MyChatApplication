<?php
    include 'includes/autoloader.inc.php';
    $user =  new UsersContr();//instantiate the contreller class
    $user->setActivestatus("not_active", $_SESSION['unique_id']);
    session_unset();
    header("Location: index.php");