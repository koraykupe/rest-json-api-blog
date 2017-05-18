A Basic Blog with Rest Json Api
==================

# Installation
* Run composer install to install 3rd party packages/bundles
* Edit your `app/config/parameters.yml` file to set database configurations
* Run `php bin/console doctrine:database:create` to create the database
* To generate public and private key make a new directory to hold the keys `mkdir -p var/jwt`
* run `openssl genrsa -out var/jwt/private.pem -aes256 4096`
* run `openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem`

# Description
I tried to follow jsonapi.org standards, PSR-2 code style, PSR-4 for autoloading.

You should use SSL in your prod environment.

JWT is used to secure the API.

Doctrine2 is used for entities and database actions.

# Requirements
* PHP7.0 or later
* OpenSSL

# Tests
* Run `./vendor/bin/simple-phpunit` to run the tests . It will install phpunit packages at first.
* You have to allow your ip address in the `web/app_dev.php` file in web folder, or just remove the complete security in that file.
* Copy the phpunit config `cp phpunit.xml.dist phpunit.xml`
* Open phpunit.xml and change the base url of the tests in TEST_BASE_URL.
* Then, you can use `./vendor/bin/simple-phpunit -c phpunit.xml` to run the tests.s

# Endpoints
All API endpoints start with `/api/`

**Get a Token**

`POST /api/tokens`

**Create an Article**

`POST /api/articles`

Example input:

```json
{
	"title": "Test",
	"content": "Lorem ipsum..."
}
```


Example Output:

```json
{
    "id": 1,
	"title": "Test",
	"content": "Lorem ipsum..."
}
```
 
**Get An Article**

`GET /api/articles/{id}`

Example Output:

```json
{
  "id": 1,
  "title": "Test",
  "content": "Lorem ipsum..."
}
```
 
 
**Get All Articles** 

`GET /api/articles/list`

Example Output:

```json
{
   "articles": [
     {
       "id": 1,
       "title": "Demneme",
       "content": "DSFdsfsd dsf"
     },
     {
       "id": 2,
       "title": "Demneme",
       "content": "DSFdsfsd dsf"
     }
   ]
 }
 ```


# 3rd Party Packages
* Guzzle to make HTTP requests in tests
* Faker to generate some fake data in tests

# Bundles
* FOSRestBundle: Accepts requests and returns appropriate response accordingly.
* 
* JMSSerializerBundle: It serialize data according to requested format (e.g json, xml, yaml)
* DoctrineFixturesBundle: To purge database after running the tests

# To-do
* Frontend part
* Using a Serializer
* Return article data in data variable
* Repositories
* Filters and ordering options for list service
* Pagination for list service
* Better error codes
* User registration and login system (multi users)
* Ability to update an article
* Ability to delete an article
* Categories
* Ability to use a different test database