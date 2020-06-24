#!/bin/bash

DEV=0;
DEBUG=0
while :; do
    case $1 in
        -d|--dev) DEV=1 ;;
        --debug) DEBUG=1 ;;
    *) break
    esac
    shift
done

# Check we are running from the root of the plugin
if [ ! -d bin ]; then
    echo 'This script must be run from the repository root.'
    exit 1
fi

SCRIPT="$@"

if [ $DEV == 1 ]; then
    docker-compose build
fi

if [ $DEBUG == 1 ]; then
   docker-compose run codeception run --debug
else
    if [ -z "$SCRIPT" ]
    then
       docker-compose run codeception run
    else
       docker-compose run codeception run $SCRIPT
    fi
fi
