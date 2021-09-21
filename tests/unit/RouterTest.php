<?php
use \BIT703\Classes\Router as Router;

class RouterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $router;
    
    protected function _before()
    {
        $this->router = new Router();
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->assertInstanceOf('\BIT703\Classes\Router', $this->router);
    }
}
?>