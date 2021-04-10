<?php
    session_start();
    spl_autoload_register('myAutoloader');//Run the autoloader function and pass-in the method created below  

    function myAutoloader($className){//Autoload the flie when class name is called
        $path = "classes/";
        $extention = ".class.php";
        $fullPath = $path . $className . $extention;

        include_once $fullPath;
    }