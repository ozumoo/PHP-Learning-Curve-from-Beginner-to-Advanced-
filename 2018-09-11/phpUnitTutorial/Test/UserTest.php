<?php

namespace phpUnitTutorial\Test;

use phpUnitTutorial\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testSetPasswordReturnsTrueWhenPasswordSuccessfullySet()
	{
    	$details = array("hi");

	    $user = new User($details);
	    
	    $password = 'fubar';

	    $user->setPassword($password);

	    $expectedPasswordResult = '5185e8b8fd8a71fc80545e144f91faf2';

	    $currentUser = $user->getUser();

	    $this->assertEquals($expectedPasswordResult, $currentUser['password']);
	}
}