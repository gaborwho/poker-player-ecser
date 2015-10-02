#!/bin/sh

cd tests
../vendor/bin/phpunit test.php
../vendor/bin/phpunit testgamestate.php
cd -
