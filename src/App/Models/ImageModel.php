<?php
namespace BIT703\Models;

use BIT703\Classes\Model;
use BIT703\Classes\FileUpload as FileUpload;
use BIT703\Classes\Messages as Messages;
use BIT703\Classes\Filter as Filter;

/*
 * Model to query images from the database.
 *
 * @package BIT703
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Open Polytechnic <info@openpolytechnic.ac.nz>
 * @copyright Open Polytechnic, 2018
 */
class ImageModel extends Model
{

	/*
	 * Gets the 8 latest images 
	 * from the database as well as 
	 * all the current user's images 
	 * if they are logged in
	 * 
	 * @return array $images Array of all image data
	 */
	public function getImages()
	{
		$images = ['others_images', 'user_images', 'tags'];
		if (isset($_SESSION['is_logged_in'])) {
			//TODO include the user ID
			$user_id = $_SESSION['user_data']['id'];
			$this->prepare('SELECT * FROM images WHERE user_id = ORDER BY id DESC LIMIT 24');
			$images['user_images'] = $this->resultSet();
			//TODO include the user ID
			$this->prepare('SELECT * FROM images WHERE user_id != ORDER BY id DESC LIMIT 8');
			$images['others_images'] = $this->resultSet();
		} else {
			$this->prepare('SELECT * FROM images ORDER BY id DESC LIMIT 8');
			$images['others_images'] = $this->resultSet();
		}
		$this->prepare( 
			"SELECT tags.tag, COUNT(image_tags.tag_id) as count
				FROM tags
				LEFT JOIN image_tags 
				ON tags.id = image_tags.tag_id
				GROUP BY tags.tag
				ORDER By COUNT(image_tags.tag_id) DESC"
		);
		$images['tags'] = $this->resultSet();
		return $images;
	}

	/*
	 * Sanitizes $_POST array to insert into the images table.
	 * Handles $_FILE uploads via the FileUpload class.
	 * Inserts compliant images with urls, title, description, 
	 * tags and filter type
	 * 
	 * @return void
	 */
	public function add()
	{
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'images');
		}

		// Sanitize POST
		$post = filter_var_array($request['post'], FILTER_SANITIZE_STRING);
		// FileUpload will sanitize this for us - yay!
		$files = $request['files'];
		
		// Return if the form is missing required data
		if ($post['submit']) {
			if ($post['title'] == '' 
				|| $post['filter'] == '' 
				|| empty($files['file'])){
				//TODO add the right message
				Messages::setMessage('', 'error');
				return;
			}
			
			// Upload the file to the user's directory in Public/filtered
			$user_id = $_SESSION['user_data']['id'];
			$destination = 'filtered' . DIRECTORY_SEPARATOR . 'user_' . $user_id;
			$upload = FileUpload::factory($destination);
			$upload->file($files['file']);
			//set max. file size (in mb)
			$upload->set_max_file_size(5);
			//set allowed mime types
			$upload->set_allowed_mime_types(array(
				'image/jpeg',
				'image/png'
			));
			$results = $upload->upload();
			//Error on upload so return with the message
			if (!empty($results['errors'])) {
				Messages::setMessage(implode(",", $results['errors']), 'error');
				return;
			}

			// We have the new file name (a has string created on upload) so add to insert
			$url = '/filtered/user_' . $user_id . '/' . $results['filename'];
			// Insert into new image into MySQL
			$image_insert_id = $this->insertImage($post, $url, $user_id);
			if ($image_insert_id) {
				$tags = explode(",", $post['tags']);
				foreach($tags as $tag){
					//TODO Pass the insert id in
					$this->insertTag(strtolower(trim($tag)));
				}
				// Redirect
				Messages::setMessage('Your image has been added', 'success');
				header('Location: ' . ROOT_URL . 'image');
				return;
			}
		}
	}

	/*
	 * Just handles image insert into DB
	 * 
	 * @param $post array the sanitized $_POST array
	 * @param $url string the image URI
	 * @param $user_id integer the user ID
	 * @return void
	 */
	public function insertImage($post, $url, $user_id)
	{
		// Insert into MySQL
		$this->prepare('INSERT INTO images (title, description, url, filter, user_id) VALUES(:title, :description, :url, :filter, :user_id)');
		$this->bind(':title', $post['title']);
		$this->bind(':description', $post['description']);
		$this->bind(':url', $url);
		$this->bind(':filter', $post['filter']);
		$this->bind(':user_id', $user_id);
		$this->execute();
		return $this->lastInsertId();
	}

	/*
	 * Inserts unique tags into the tag table 
	 * and adds record for every tag with the image_id 
	 * in the images_tags table
	 * 
	 * @param $tag string the tag
	 * @param $image_insert_id integer the image ID
	 * @return void
	 */
	public function insertTag($tag, $image_insert_id)
	{
		// Insert into MySQL
		$this->prepare('INSERT INTO tags (tag) VALUES (:tag) ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)');
		$this->bind(':tag', $tag);
		$this->execute();
		$tag_insert_id = $this->lastInsertId();
		
		// Insert into MySQL
		$this->prepare('INSERT INTO image_tags (image_id, tag_id) VALUES (:image_insert_id, :tag_insert_id)');
		$this->bind(':image_insert_id', $image_insert_id);
		$this->bind(':tag_insert_id', $tag_insert_id);
		$this->execute();
	}
}