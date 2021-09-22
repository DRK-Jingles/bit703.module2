<?php
/*
 * This file contains our defined constants
 */
require  'config.php';

/*
 * If we are in development, show all errors, otherwise suppress them 
 */
if (DEV_ENV) {
    error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
} else {
    error_reporting(0);
}
require 'utils.php';

