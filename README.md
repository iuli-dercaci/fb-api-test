#football API test

To install basically you need

- `clone` the project
- use `composer` in order to deal with the 
dependencies
- copy the contents of the `.env.dist` into `.env` file 
- correct your DB connection details in the `.env` file
- run `php bin/console doctrine:database:create` in order to create a DB
- run `php bin/console doctrine:migrations:migrate` in order to run all the migrations
- run `php bin/console doctrine:fixtures:load` in order to populate DB with the test data 

In case if you use PHPStorm you can use for your tests prepared request files
or just use them as a kind of reference for your own.
You do need to generate keys for the JWT authorization, it is already included for the 
test in the corresponding folder.

###api endpoints:

**_auth token request_**
`POST` /api/login_check 

**_league data_**
`GET` /api/league/{id} 

**_league delete_**
`DELETE` /api/league/{id} 

**_team_create_**
`POST` /api/team 

*_expects team data as a json object_*
*_with the following keys:_*
* name 
* strips 
* league_id (optional)

**_team_update_**
`PUT` /api/team/{id} 

*_expects team data as a json object_*
*_with the following keys:_*
* name 
* strips 
* league_id (optional)
 
 

###additional folders:

**_Doctrine Migrations_**
- src/Migrations

**_Doctrine Data Fixtures_**
- src/DataFixtures

**_test request files (for PHPStorm IDE)_**
- requests

**_authorization key files_**
- config/jwt


###additional config data:

default DB and JWT related settings are set in the `.env.dist` file 