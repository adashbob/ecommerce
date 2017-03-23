E-commerce application in Symfony 3

## Building the project

The project is a simple E-Commerce in symfony 3. To build the whole project, just run :
 - `clone https://github.com/adashbob/ecommerce.git`
 - `php composer.phar install`
 - `php bin/console asset:install --symlink`
 - `bower install`
 - `grunt install ; grunt` (before install grunt-cli by: `sudo npm install -g grunt-cli`)
 
Refer to app/config/parameters.yml.dist to configure a database and run : 
- `php bin/console doctrine:schema:create --dump-sql --force`
- `php bin/console h:d:f:l` create fixtures

Run the app:
- `php bin/console server:run`

If installation of package or you have error to running project try:
`sudo chmod -R 777 var/*`

