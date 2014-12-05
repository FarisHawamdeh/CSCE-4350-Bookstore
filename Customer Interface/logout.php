<?php

	session_start();

	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {} 

    else
    {
            header("location:login.php");
    }

	session_destroy();
	header("location:login.php");
?>