#!/bin/bash

set -e


handle_error_startup() {
  echo "Error in startup.sh. Sleeping for ${EXIT_WAIT_TIME} seconds then will exit ..."
  sleep ${EXIT_WAIT_TIME}
  echo "Exiting..."
}

trap 'handle_error_startup' ERR

echo "Running startup.sh..."

#composer install
echo "Running composer install..."
composer install --no-interaction --no-dev --prefer-dist

# Check if We need Git info file
if [ -f "app-info.template" ]; then
	echo "app-info.template file found"
	if [ "${APP_INFO}" = "true" ]; then
	  echo "Creating app-info.php file"
    ALL_ENV_VARIABLE=$(printf '${%s} ' $(env | cut -d= -f1))
    # Replace environment variables within the application/code/app-info.template file
    envsubst "$ALL_ENV_VARIABLE" < "app-info.template" > "public/app-info.php"
	fi
  echo "Removing app-info.template file"
  rm "app-info.template"
fi

# Check if Artisan exists, lets clear its cache
if [ -f artisan ]; then
  echo "Initialization Portal Application, Environment:$APP_ENV"

  echo "Initializing files and updating permissions..."


  # Update permissions
  touch storage/logs/laravel.log
  touch storage/logs/debug_laravel.log
  chmod -R 0777 storage

  # Clear cache - laravel will rebuild it on first run
  mkdir -p bootstrap/cache
  chmod -R 0777 bootstrap
  rm -f bootstrap/cache/*


  echo "Run migrations"
  php artisan migrate

  echo "Clearing cache"

  # Clearing Cache
  php artisan optimize:clear

  echo "Finished environment initialization"

fi
