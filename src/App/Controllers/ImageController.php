<?php
namespace BIT703\Controllers;

use BIT703\Classes\Controller;
use BIT703\Models\ImageModel as ImageModel;

/*
 * Class to process image adding and viewing requests.
 *
 * @package BIT703
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Open Polytechnic <info@openpolytechnic.ac.nz>
 * @copyright Open Polytechnic, 2018
 */
class ImageController extends Controller
{
	/*
	 * Instantiates the ImageModel
	 * 
	 * @return void
	 */
	protected function baseMethod($request = [])
	{
		$model = new ImageModel();
		$this->returnView($model->getImages(), 'image');
	}

	/*
	 * Instantiates the ImageModel
	 * and calls the add method
	 * 
	 * @return void
	 */
	 //TODO Something is missing
	protected function add($request)
	{
		$model = new ImageModel($request);
		$this->returnView($model->add($request));
	}
}