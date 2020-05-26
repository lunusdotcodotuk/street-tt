# phpunit
A Docker container to run php 7.4 and PHPUnit

You will need docker installed (or simply run on local php from src directory)

Run `docker-compose up -d` in the root directory.

Run `docker exec -it street-tt bash` from project root.

Now, in the `src` directory, you need to run `composer install`. 

Run tests with `./vendor/bin/phpunit tests`.

Web server available on `http://localhost`. 
