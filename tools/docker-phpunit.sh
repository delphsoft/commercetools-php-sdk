#!/bin/sh
set -e

service redis-server start

composer -n install --prefer-dist -o
vendor/bin/phpunit --printer PHPUnit\\TeamCity\\TestListener "$@"
