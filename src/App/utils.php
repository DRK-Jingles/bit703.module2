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
    print("<pre>".print_r($relative_class, 1)."</pre>");
  
    /*
     *  Replace the namespace prefix with the base directory, replace namespace
     *  separators with directory separators in the relative class name, append
     *  with .php
     */
    $file = APP_ROOT . str_replace('\\', '/', $relative_class) . '.php';
    print("<pre>".print_r($file, 1)."</pre>");
  
    die();
    
    /*
     *  if the file exists, require it
     */
    if (file_exists($file)) {
        require $file;
    }
  });
  $router = new \BIT703\Classes\Router();