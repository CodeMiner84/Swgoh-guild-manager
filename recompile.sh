#!/usr/bin/env bash

composer install &&
yarn install &&
./bin/console doctrine:database:drop --force &&
./bin/console doctrine:database:create &&
yes | ./bin/console doctrine:migrations:migrate &&
yes | ./bin/console doctrine:fixtures:load &&
./bin/console assets:install &&
./bin/console cache:clear &&
yarn run encore dev
