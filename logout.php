<?php
session_start();
unset($_SESSION["newsession"]);
session_destroy();
header('location: index.php');
