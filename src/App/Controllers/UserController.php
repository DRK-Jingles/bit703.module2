<?php
namespace BIT703\Controllers;
 
/*
 * These have to be fully namespaced 
 * as they are in a separate namespace
 */
use BIT703\Classes\Controller;
 
/*
 * Class to process home page requests.
 *
 * @package BIT703
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Open Polytechnic <info@openpolytechnic.ac.nz>
 * @copyright Open Polytechnic, 2018
 */

class UserController extends Controller
{
    /*
     * Instantiates the UserModel 
     * to handle registration
     * 
     * @return void
     */
    public function register($request)
    {
    }
 
    /*
     * Instantiates the UserModel 
     * to handle logins
     * 
     * @return void
     */
    public function login($request)
    {
    }
 
    /*
     * Logs user out, destroys the session 
     * and redirection to home
     * 
     * @return void
     */
    public function logout()
    {
    }
}