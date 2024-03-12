#!/bin/bash
set -e

handle_error_entrypoint() {
  echo "Error in custom-entrypoint.sh. Sleeping for ${EXIT_WAIT_TIME} seconds then will exit ..."
  sleep ${EXIT_WAIT_TIME}
  echo "Exiting..."
}
trap 'handle_error_entrypoint' ERR

EXIT_WAIT_TIME=5

if [ ! -z "${CONTAINER_ERROR_WAIT_TIME}" ]; then
  EXIT_WAIT_TIME=${CONTAINER_ERROR_WAIT_TIME}
fi

export EXIT_WAIT_TIME=${EXIT_WAIT_TIME}

#Printing env variables for debuggging purposes
#Note: this should be enabled only for debugging purposes
if [ "${CONTAINER_PRINT_ENV_VARIABLES}" == "true" ]; then
  echo "Environment variables: "
  printenv
fi

if [ -z "${PHP_SESSION_SAVE_HANDLER}" ]; then
  export PHP_SESSION_SAVE_HANDLER=files
fi

if [ -z "${PHP_SESSION_SAVE_PATH}" ]; then
  export PHP_SESSION_SAVE_PATH=/tmp
fi

if [ -z "${PHP_SEND_MAIL_PATH}" ]; then
  export PHP_SEND_MAIL_PATH=""
fi

echo "#### STARTING ExcelDataUploader - PHP"

# Configuring PHP INI
if [ -f "/usr/local/etc/php/conf.d/custom.ini.template" ]; then
  echo "Creating Custom PHP configurations"
  EXPORT_ENVIRONMENT_VARIABLES='\$PHP_SESSION_SAVE_HANDLER \$PHP_SESSION_SAVE_PATH \$PHP_SEND_MAIL_PATH'
  envsubst "$EXPORT_ENVIRONMENT_VARIABLES" < /usr/local/etc/php/conf.d/custom.ini.template > /usr/local/etc/php/conf.d/custom.ini
fi

# Portal initialization script
if [ -f "/usr/local/bin/startup.sh" ]; then
  echo "Running startup.sh..."
  . /usr/local/bin/startup.sh $@
fi

# Welcome Message
echo "Default startup script with $@"
exec "$@"
