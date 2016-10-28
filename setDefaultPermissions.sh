#!/bin/bash

rm -rf ./app/cache/*
rm -rf ./app/logs/*

HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
# if this doesn't work, try adding `-n` option
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX ./app/cache ./app/logs
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX ./app/cache ./app/logs