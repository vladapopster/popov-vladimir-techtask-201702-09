Recipes
------
Global API that provides lunch menu based on provided ingredients.

Prerequisites
------
Installed Composer. Can be obtained from https://getcomposer.org/.

Installation
------
Run `composer update`.
Set Virtual host pointing to `public/index.php`.
Hit `/lunch` route from previously set host

Tests
------
Test suit can be run from project root `bin/phpunit.phar`

Possible future improvements 
------
- [ ] Move constants to config files
- [ ] Consider later using some ORM and better repository linking
- [ ] Use some API documentation like Nelmio
- [ ] Proper Vagrant file with puppet