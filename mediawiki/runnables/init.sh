#!/usr/bin/env bash
if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

sleep 10
# disable settings so we can ask the installer to setup database
#mv LocalSettings.php LocalSettings.php.shadow
# re-enable settings
#mv LocalSettings.php.shadow LocalSettings.php
bash $MW_INSTALL_PATH/runnables/permit.sh

#if [ "$MW_DB_TYPE" = "sqlite" ]; then
#bash $MW_INSTALL_PATH/runnables/setup_sqlite.sh
#elif [ "$MW_DB_TYPE" = "mysql" ]; then
#bash $MW_INSTALL_PATH/runnables/setup_mysql.sh
#fi
#
bash $MW_INSTALL_PATH/runnables/update.sh
php-fpm
