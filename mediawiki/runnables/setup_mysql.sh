#!/bin/bash

if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

php maintenance/install.php \
        --server=$MW_SERVER \
        --dbname=$MW_DB_NAME \
        --scriptpath="" \
        --dbtype=mysql \
        --dbserver=$MW_DB_SERVER \
        --dbuser=$MW_DB_USER \
        --dbpass=$MW_DB_PASSWORD \
        --pass=admin \
        $MW_SITENAME \
        $MW_ADMIN
# re-enable settings
#mv LocalSettings.php LocalSettings.php.old
#mv LocalSettings.php.shadow LocalSettings.php
