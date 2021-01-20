## Configuration
Local server
cp config/app.php.local config/app.php
Production Server
cp config/app.php.production config/app.php


## Create folder
mkdir tmp

mkdir tmp/bake

mkdir tmp/cache

mkdir tmp/cache/models

mkdir tmp/cache/persistent

mkdir tmp/cache/twigView

mkdir tmp/cache/views

mkdir tmp/sessions

mkdir tmp/tests

## Permissions
sudo chmod -R 775 ./
sudo chown -R apache ./

## Database
CREATE SCHEMA microblog_chaste DEFAULT CHARACTER SET utf8;