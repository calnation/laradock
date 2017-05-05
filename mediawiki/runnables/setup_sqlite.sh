#!/bin/bash

if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

mkdir -p "$MW_INSTALL_PATH/data"

php maintenance/install.php \
        --server=$MW_SERVER \
        --dbname=$MW_DB_NAME \
        --scriptpath="" \
        --dbtype=sqlite \
        --dbpath="$MW_INSTALL_PATH/data" \
        --pass=admin \
        $MW_SITENAME \
        $MW_ADMIN
echo ""
echo "Development wiki created with admin user $MW_ADMIN and password 'admin'."
echo ""
# re-enable settings
mv LocalSettings.php LocalSettings.php.old
mv LocalSettings.php.shadow LocalSettings.php
