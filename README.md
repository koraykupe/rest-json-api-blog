A Basic Blog with Rest Json Api
==================

# Installation
* Run composer install to install 3rd party packages/bundles
* Edit your `app/config/parameters.yml` file to set database configurations
* Run `php bin/console doctrine:database:create` to create the database

# Description
I tried to follow jsonap.org standards, PSR-2 code style, PSR-4 for autoloading.

# Bundles
* FOSRestBundle: Accepts requests and returns appropriate response accordingly.
* JMSSerializerBundle: It serialize data according to requested format (e.g json, xml, yaml)

# To-do
* User registration and login system (multi users)
* Ability to update an article
* Ability to delete an article
* Subcategories