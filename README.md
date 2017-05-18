A Basic Blog with Rest Json Api
==================

# Installation
* Run composer install to install 3rd party packages/bundles
* Edit your `app/config/parameters.yml` file to set database configurations
* Run `php bin/console doctrine:database:create` to create the database

# Description
I tried to follow jsonapi.org standards, PSR-2 code style, PSR-4 for autoloading. You should use SSL in your prod environment.

# Tests
Run `./vendor/bin/simple-phpunit` to run the tests . It will install phpunit packages at first.
You have to allow your ip address in the `web/app_dev.php` file in web folder, or just remove the complete security in that file.
You can create a phpunit.xml file by copying phpunit.xml.dist and add `<directory>src/*Bundle/Tests</directory>` within it.
Then, you can use `./vendor/bin/simple-phpunit -c phpunit.xml` to run the tests.s

# 3rd Party Packages
* Guzzle to make requests in tests
* Faker to generate some fake data in tests

# Bundles
* FOSRestBundle: Accepts requests and returns appropriate response accordingly.
* JMSSerializerBundle: It serialize data according to requested format (e.g json, xml, yaml)

# To-do
* User registration and login system (multi users)
* Ability to update an article
* Ability to delete an article
* Subcategories