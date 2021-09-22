<?php

/* 
 * spl_autoload_register() allows you to register multiple functions 
 * (or static methods from your own Autoload class) 
 * that PHP will put into a stack/queue and call sequentially 
 * when a "new Class" is declared. 
 */
spl_autoload_register(function ($class) {

    /*
     *  Project-specific namespace prefix
     */
    $prefix = 'BIT703\\';
  
    /*
     *  Does the class use the namespace prefix?
     */
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
  
    /*
     *  Get the relative class name
     */
    $relative_class = substr($class, $len);
  
    /*
     *  Replace the namespace prefix with the base directory, replace namespace
     *  separators with directory separators in the relative class name, append
     *  with .php
     */
    $file = APP_ROOT . str_replace('\\', '/', $relative_class) . '.php';
    
    /*
     *  if the file exists, require it
     */
    if (file_exists($file)) {
        require $file;
    }
});

function generateRandomString($length)
{ 
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charsLength = strlen($characters) -1;
    $string = "";
    for($i=0; $i<$length; $i++){
        $randNum = mt_rand(0, $charsLength);
        $string .= $characters[$randNum];
    }
    return $string;
}
  