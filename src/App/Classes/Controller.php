<?php
namespace BIT703\Classes;
 
/*
 * The abstract Controller class 
 * inherited by all controllers.
 *
 * @package BIT703
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Open Polytechnic <info@openpolytechnic.ac.nz>
 * @copyright Open Polytechnic, 2018
 */
abstract class Controller
{
    
    /*
     * The controller 
     * method being accessed.
     *
     * @var string
     */
    protected $method;
    
    /*
     * The default controller method. 
     * Called if no method is set
     *
     * @var string
     */
    protected $base_view;
    
    /*
     * The view to be served, 
     * found in 'App/Views/'. $view. '.php';
     *
     * @var string
     */
    protected $view;
 
    /*
     * Magic method called when 
     * each class instance is created
     * 
     * @param string $method A string matching a conroller method
     * @return void
     */
    public function __construct($method)
    {
        /*
         * This will ensure at least the 
         * base method will be called
         */
        if ($method === "") {
            $this->method = 'baseMethod';
        } else {
            $this->method = $method;
            $this->view = $method;
        }
    }
 
    /*
     * Run any assigned controller method
     * 
     * @return void
     */
    public function executeMethod($request = [])
    {
        return $this->{$this->method}($request);
    }
 
    /*
     * Set a default method to run when 
     * no method parameter is passed
     * 
     * @return void
     */
    protected function baseMethod($request = [])
    {
        /*
         * This will fail if developers 
         * forget to include a baseMethod 
         * in their child controller class
         */
        throw new \Exception(sprintf("Method '%s' not implemented. Must be over-ridden in subclass.", __METHOD__));
    }
 
    /*
     * A setter to prevent improper access
     * 
     * @return param $view the assigned view
     * @return void
     */
    protected function setView($view)
    {
        $this->view = $view;
    }
 
    /*
     * A getter to prevent improper access
     * 
     * @return string $this->view the assigned view
     */
    protected function getView()
    {
        return $this->view;
    }
 
    /*
     * Returns entire document including the view
     * 
     * @param $model the assigned model
     * @param $view the assigned view
     * @return void
     */
    protected function returnView($model, $view = "")
    {
        if ($view !== "") {
            $this->setView($view);
        }
        require(VIEW_ROOT . 'header.php');
        require(VIEW_ROOT . strtolower($this->getView(). '.php'));
        require(VIEW_ROOT . 'footer.php');
    }
}