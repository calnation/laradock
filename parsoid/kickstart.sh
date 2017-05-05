#!/bin/bash
# APP_URL: the URL of you MediaWiki API endpoint.
if [[ "$APP_URL" == "" ]]
then
  echo "Missing APP_URL"
  exit 1
fi
# list of supported subdomain
langs="en es"
{
 echo "worker_heartbeat_timeout: 300000"
 echo "logging:"
 echo " level: info"
 echo "services:"
 echo "- module: lib/index.js"
 echo "  entrypoint: apiServiceWorker"
 echo "  conf:"

 echo "   mwApis:"
 for lang in $langs ; do
   echo "   - uri: 'http://$lang.$APP_URL/api.php'"
   echo "     domain: '$lang.$APP_URL'"
 done
 echo "   loadWMF: false"
 echo "   useSelser: true"
} > /parsoid/config.yaml

cd /parsoid

exec npm start
