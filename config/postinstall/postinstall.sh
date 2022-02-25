#!/bin/bash

NPM=$(which npm)
COMPOSER=$(which composer)

SCRIPT_PATH=$(readlink -f $(readlink -f "$(dirname $0)/$(basename $0)"))

SERVER_PATH=$(dirname $(dirname $(dirname ${SCRIPT_PATH})))

cd ${SERVER_PATH}

if [ -z ${COMPOSER} ]; then
    COMPOSER=$(which composer.phar)
    if [ -z ${COMPOSER} ]; then
       echo "composer not installed!!!"
       exit 1
    fi
fi

if [ -z ${NPM} ]; then
    echo "npm not installed!!!"
    exit 2
fi

${COMPOSER} install
bin/console doctrine:schema:update --force
bin/console doctrine:migrations:migrate
npm install
npm run build