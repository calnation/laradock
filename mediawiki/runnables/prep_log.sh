#!/usr/bin/env bash
if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

mkdir -p /var/log/mediawiki/debuglogs
chmod 666 -R -f /var/log/mediawiki
chown -R www-data:www-data /var/log/mediawiki
chown -R www-data:www-data /var/log/mediawiki
