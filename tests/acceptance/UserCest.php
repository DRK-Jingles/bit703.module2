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
    public function testUserLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/user/login');
        $I->fillField('email', 'test@test.com');
        $I->fillField('password', 'test');
        $I->click('Submit');
        $I->see('Welcome Open Polytechnic');
    }

    // tests
    public function testIncompleteRegistration(AcceptanceTester $I)
    {
        $random_string = \generateRandomString(8);
        $I->amOnPage('/user/register');
        $I->fillField('email', $random_string . '@test.com');
        $I->fillField('password', '');
        $I->fillField('name', $random_string);
        $I->click('Submit');
        $I->see('Please fill in all fields');
    }

    // tests
    public function testUserRegistration(AcceptanceTester $I)
    {
        $random_string = \generateRandomString(8);
        $I->amOnPage('/user/register');
        $I->fillField('email', $random_string . '@test.com');
        $I->fillField('password', $random_string);
        $I->fillField('name', $random_string);
        $I->click('Submit');
        $I->see('Welcome ' . $random_string);
    }

    // tests
    public function testDuplicateUserRegistration(AcceptanceTester $I)
    {
        $random_string = \generateRandomString(8);
        $I->amOnPage('/user/register');
        $I->fillField('email', 'test@test.com');
        $I->fillField('password', $random_string);
        $I->fillField('name', $random_string);
        $I->click('Submit');
        $I->see('This email has already been registered');
    }
}
