E-commerce application in Symfony 3

## Building the project

The project is a simple APIRestFul E-Commerce in symfony 3 and angularjs. To build the whole project, just run :
 - `clone https://github.com/adashbob/ecommerce.git`
 - `php composer.phar install`
 - `bower install`
 - `grunt install ; grunt` (before install grunt-cli by: `sudo npm install -g grunt-cli`)
 
Refer to app/config/parameters.yml.dist to configure a database and run : 
- `php bin/console doctrine:schema:create`
- `php bin/console h:d:f:l` create fixtures

