<?php
// Don't show admin verification scree
add_filter( 'admin_email_check_interval', '__return_false' );