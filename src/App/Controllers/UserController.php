<?php
namespace BIT703\Controllers;

use BIT703\Classes\Controller;
use BIT703\Models\UserModel as UserModel;

/*
 * Class to process user requests.
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
	 * to handle logins
	 * 
	 * @return void
	 */
	protected function login($request)
	{
		$model = new UserModel($request);
		$this->returnView($model->login($request));
	}

	/*
	 * Instantiates the UserModel 
	 * to handle registration
	 * 
	 * @return void
	 */
	protected function register($request)
	{
		$model = new UserModel($request);
		$this->returnView($model->register($request));
	}

	/*
	 * Logs user out, destroys the session 
	 * and redirection to home
	 * 
	 * @return void
	 */
	protected function logout()
	{
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_data']);
		session_destroy();
		// Redirect
		header('Location: /');
	}
}