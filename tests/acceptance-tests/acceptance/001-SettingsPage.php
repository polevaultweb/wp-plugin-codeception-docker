<?php

$I = new AcceptanceTester( $scenario );

$I->wantTo( 'See if the setting page exists for the plugin' );

$I->amOnAdminPage( '/options-general.php?page=wpcd' );
$I->waitForText( 'This is an example plugin, with acceptance tests written with Codeception, running in Docker', 20 );