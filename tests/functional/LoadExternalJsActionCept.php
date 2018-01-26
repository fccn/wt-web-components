<?php
$I = new FunctionalTester($scenario);
$I->wantTo('load an external js library');
$I->amOnPage('/script/lib/my_lib');
$I->seeResponseCodeIs(200);
$I->see('function myFunction()');
