#!/usr/bin/env bash
if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

php maintenance/update.php --quick --dbpass $MW_DB_PASSWORD
