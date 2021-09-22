<?php
require(dirname(__FILE__).'/../../src/App/bootstrap.php');

class UserCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function testImageExists(AcceptanceTester $I)
    {
        $I->amOnPage('/image');
		//TODO Use the correct CSS class
        $I->seeElement('.grid-item picture');
    }

    // tests
    public function testOthersImagesExist(AcceptanceTester $I)
    {
		//TODO Something is missing
        $I->amOnPage('/image');
        $I->seeNumberOfElements('#others-images img', 8);
    }

    // tests
    public function testImageUpload(AcceptanceTester $I)
    {
        $random_string = \generateRandomString(8);
        $I->amOnPage('/user/login');
        $I->fillField('email', 'test@test.com');
        $I->fillField('password', 'test');
        $I->click('Submit');
        $I->click('Upload an Image Now');
        $I->fillField('title', $random_string);
        $I->fillField('tags', $random_string);
        $I->selectOption('filter', 'hudson');
        $I->attachFile('file', 'test.jpg');
        $I->click('Submit');
        $I->see($random_string);
    }

    // tests
    public function testIncompleteImageUpload(AcceptanceTester $I)
    {
        $random_string = \generateRandomString(8);
        $I->amOnPage('/user/login');
        //TODO Write the rest of this test
        $I->fillField('email', 'test@test.com');
        $I->fillField('password', 'test');
        $I->click('Submit');
        $I->click('Upload an Image Now');
        $I->fillField('title', '');
        $I->fillField('tags', $random_string);
        $I->selectOption('filter', 'hudson');
        $I->attachFile('file', 'test.jpg');
        $I->click('Submit');
        $I->see('Please include a title, a filter and a file');
    }

}
