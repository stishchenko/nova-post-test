Before start, be sure that you have php, MySQL and composer.
To start project after cloning from GitHub follow next instruction:
1. Open terminal and go to project folder
2. Run command `composer install`
3. Open project in IDE if you don\`t do it before and use branch `main`
4. Update file `.evn` to use your MySQL credentials for params DB_USERNAME and DB_PASSWORD
5. Go back to terminal and run command `php artisan migrate` to create database; enter `yes` when terminal will ask you about creating db
6. In terminal also run command `php atrisan parse:novapost --limit=20` to fill database using Nova Poshta API
7. In terminal run command `php artisan serve` to run server
8. Use url `http://localhost:8000/novapost` in browser to open app
