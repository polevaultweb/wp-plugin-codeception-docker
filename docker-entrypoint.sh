#!/bin/bash

# Allows WP CLI to run with the right permissions.
wp-su() {
    sudo -E -u www-data wp "$@"
}

# Clean up from previous tests
rm -rf /wp-core/wp-content/plugins/wp-plugin-codeception-docker

# Make sure permissions are correct.
cd /wp-core
chown -R www-data:www-data wp-content
chmod -R 755 wp-content

# Make sure the database is up and running.
while ! mysqladmin ping -hmysql --silent; do

    echo 'Waiting for the database'
    sleep 1

done

echo 'The database is ready'

# Make sure WordPress is installed.
if ! $(wp-su core is-installed); then

    echo "Installing WordPress"

    wp-su core install --url=wordpress --title=tests --admin_user=admin --admin_password=password --admin_email=test@test.com

    wp-su core config --dbhost=mysql --dbname=wordpress --dbuser=root --dbpass=wordpress --extra-php="define('WP_DEBUG', true); define('WP_DEBUG_LOG', true); define('WP_DEBUG_DISPLAY', false); define( 'SCRIPT_DEBUG', true );" --force
fi

echo "Checking for Database Upgrades"
wp-su core update-db # Avoid a splash screen, which breaks admin/builder tests.


mkdir wp-content/plugins/wp-plugin-codeception-docker
cp -r /repo/* wp-content/plugins/wp-plugin-codeception-docker/

cd /project/tests

exec "/project/tests/vendor/bin/codecept" "$@"
