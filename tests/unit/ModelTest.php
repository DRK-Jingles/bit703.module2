<?php
require(dirname(__FILE__).'/../../src/App/bootstrap.php');

use \BIT703\Models\UserModel as UserModel;

class ModelTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $model;
    
    protected function _before()
    {
        //TO DO make models
        global $codecept_testing;
        $codecept_testing = true;
        $this->model = new UserModel();
    }

    protected function _after()
    {
    }

    // tests
    public function testGetUser()
    {
        $user = $this->model->getUser(1);
        $this->assertEquals('Open Polytechnic', $user['name']);
        $this->assertEquals('test@test.com', $user['email']);
    }
}