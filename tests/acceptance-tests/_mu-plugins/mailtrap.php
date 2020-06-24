<?php
add_action( 'phpmailer_init', function ( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host     = 'smtp.mailtrap.io';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port     = 2525;
	$phpmailer->Username = '[TEST_MAILTRAP_USERNAME]';
	$phpmailer->Password = '[TEST_MAILTRAP_PASSWORD]';
} );