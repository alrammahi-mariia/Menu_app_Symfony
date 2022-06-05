# Menu_app_Symfony

An interactive Menu app where restaurant customers can view available menu items by category and restaurant staff can create and delete dish items on the menu.

# Steps to follow

1. Copy the folder to SymfonyMAMP and rename to "web". Then cd to "web"
2. Install dependencies using `composer install`
3. Install front-end dependencies using `npm install`
4. Do the migration:

   - Open file .env in "SYMFONY-MAMP" folder (not the "web" folder!)
   - Rename database to `DATABASE_NAME=MenuDB `.
   - Open Docker > symfony-mamp_www_1 > CLI
   - cd to "web" folder
   - Run `php bin/console make:migration`
   - Run `php bin/console doctrine:migrations:migrate`

5. Start Docker container SYMFONY-MAMP
6. Visit URL: http://localhost:8007/ to see the app
7. Use Crtl + C to stop the watch

# Tech stack

1.  [Symfony](https://symfony.com/)
2.  [PHP](https://www.php.net/)
3.  [MySQL](https://www.mysql.com)
4.  [SymfonyMAMP](https://github.com/kalwar/Symfony-MAMP)

# Copyright

Website template by [Colorlib](https://colorlib.com/) downloaded from [Themeslab](https://themeslab.org/). Images from [Unsplash](https://unsplash.com/)
