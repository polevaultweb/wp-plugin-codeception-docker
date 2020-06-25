<?php

// TODO WP constants not available for some reason
return;
// Here you can initialize variables that will be available to your tests
function copy_to_dir( $pattern, $dir ) {
	foreach ( glob( $pattern ) as $file ) {
		if ( ! is_dir( $file ) && is_readable( $file ) ) {
			$dest = realpath( $dir ) . DIRECTORY_SEPARATOR . basename( $file );
			copy( $file, $dest );

			$plugin_contents = file_get_contents( $dest );

			if ( basename( $file ) === 'mailtrap.php' ) {
				$plugin_contents = str_replace( '[TEST_MAILTRAP_USERNAME]', $_ENV['MAILTRAP_USERNAME'], $plugin_contents );
				$plugin_contents = str_replace( '[TEST_MAILTRAP_PASSWORD]', $_ENV['MAILTRAP_PASSWORD'], $plugin_contents );
				file_put_contents( $dest, $plugin_contents );
			}
 		}
	}
}
if ( ! is_dir( WPMU_PLUGIN_DIR ) ) {
	mkdir( WPMU_PLUGIN_DIR );
};

echo "\nCopying mu plugins to " . WP_CONTENT_DIR . '/mu-plugins';
copy_to_dir( dirname( dirname( __FILE__ ) ) . '/_mu-plugins/*.php', WPMU_PLUGIN_DIR );