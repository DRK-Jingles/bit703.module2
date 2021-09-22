<?php
namespace BIT703\Classes;

/*
 * The static Messages class.
 * Because it's static we don't create an instance, we just access it like so:
 * $message = BIT703\Classes\Messages::displayMessage();
 *
 * @package BIT703
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Open Polytechnic <info@openpolytechnic.ac.nz>
 * @copyright Open Polytechnic, 2018
 */
class Messages{

	/*
	 * Stores messages in the $_SESSION. 
	 * Creates a Bootstrap 4 alert message
	 * 
	 * @param string $text A message for the user
	 * @param string $type Accepts 'error' or will default to success
	 * @return void
	 */
	public static function setMessage($text, $type)
	{
		if($type == 'error'){
			$_SESSION['error_message'] = $text;
		} else {
			$_SESSION['success_message'] = $text;
		}
	}

	/*
	 * Retrieves messages from the $_SESSION. 
	 * 
	 * @return void
	 */
	public static function displayMessage()
	{
		if(isset($_SESSION['error_message'])){
			echo '<div class="alert alert-danger">'.$_SESSION['error_message'].'</div>';
			unset($_SESSION['error_message']);
		}

		if(isset($_SESSION['success_message'])){
			echo '<div class="alert alert-success">'.$_SESSION['success_message'].'</div>';
			unset($_SESSION['success_message']);
		}
	}

}