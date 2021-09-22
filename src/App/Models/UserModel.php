<?php
namespace BIT703\Models;

use BIT703\Classes\Model;
use BIT703\Classes\Messages as Messages;

/*
 * Model to handle user registration, 
 * logging in and logging out
 *
 * @package BIT703
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Open Polytechnic <info@openpolytechnic.ac.nz>
 * @copyright Open Polytechnic, 2018
 */
class UserModel extends Model
{
	
	/*
	 * Checks that email isn't registered 
	 * then resgister the user and 
	 * redirects to the login page
	 * 
	 * @return void
	 */
	public function register($request)
	{
		// Sanitize POST
		if (isset($request['post']['submit'])) {
			$post = filter_var_array($request['post'], FILTER_SANITIZE_STRING);
			$password = md5($post['password']);

			if ($post['name'] == '' || $post['email'] == '' || $post['password'] == '') {
				Messages::setMessage('Please fill in all fields', 'error');
				return;
			}

			$this->prepare('SELECT * FROM users WHERE email = :email');
			$this->bind(':email', $post['email']);
			$row = $this->single();
			if ($row) {
				Messages::setMessage('This email has already been registered', 'error');
				return;
			}

			// Insert into MySQL
			$this->prepare('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
			$this->bind(':name', $post['name']);
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			$this->execute();
			$user_id = $this->lastInsertId();
			// Verify
			if ($user_id) {
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id"	=> $user_id,
					"name"	=> $post['name'],
					"email"	=> $post['email']
				);
				header('Location: /');
			}
		}
		return;
	}

	/*
	 * Logs the user in and 
	 * redirects to the images page
	 * 
	 * @return void
	 */
	public function login($request)
	{
		// Sanitize POST
		if (isset($request['post']['submit'])) {
			$post = filter_var_array($request['post'], FILTER_SANITIZE_STRING);
			$password = md5($post['password']);
			// Compare Login
			$this->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
			$this->bind(':email', $post['email']);
			$this->bind(':password', $password);
			
			$row = $this->single();

			if ($row) {
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id"	=> $row['id'],
					"name"	=> $row['name'],
					"email"	=> $row['email']
				);
				header('Location: /');
			} else {
				Messages::setMessage('', 'error');
			}
		}
		return;
	}
}