<?php
include "config.php";
include 'function.php';
define_settings();
if($_SESSION['language'])
{
    
    $lang = $_SESSION['language'];
}
set_laguage();
// destroy the session
session_destroy(); 
session_start();
$_SESSION['language'] = $lang;

header("Location: index.php"); 