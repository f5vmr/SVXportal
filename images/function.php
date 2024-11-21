<?php
session_start();
function set_laguage() {
    // Check if gettext is enable
    if(!function_exists("gettext")) die("gettext is not enable");
    
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
    // Processes \r\n's first so they aren't converted twice.
    $lang = str_replace("-", "_", $lang);
    $lang= trim($lang);
    
    $directory = dirname(__FILE__).'/locale';
    $domain = 'svxportal';

    $locale =$lang; //like pt_BR.utf8";
    if($_SESSION['language'])
    {
        $locale = $_SESSION['language'];

    }
    
    
    putenv("LANG=".$locale); //not needed for my tests, but people say it's useful for windows
    
    setlocale( LC_MESSAGES, $locale);
    bindtextdomain($domain, $directory);
    textdomain($domain);
    bind_textdomain_codeset($domain, 'UTF-8');
    
    
}
function post_language()
{
    if($_POST['locate_lang'])
    {
        $_SESSION['language'] = $_POST['locate_lang'];
    }
    
}

?>