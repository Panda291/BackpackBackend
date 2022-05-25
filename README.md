## Backpack Backend

To set up the backend you can perform the following steps.
These instructions work on a UNIX based machine, for windows users I advise the use of WSL.

- Install PHP 8.1, a decent amount of extensions are required. For ubuntu machines you can find a guide [here](https://www.cloudbooklet.com/how-to-install-or-upgrade-php-8-1-on-ubuntu-20-04/).
For other platforms, the page contains a useful list of common php extension.
- [Install composer](https://getcomposer.org/).
- Prepare any database, this can be local or remote. For the creation of this project I used [MariaDB](https://mariadb.com/).
- copy the `.env.example` file to `.env`. Then you can fill in the database login information in the `DB_*` section. Note that if you use a database type other than `mysql` you must also fill that in for these values.
- execute `composer install`. This should yield no errors, if they do: You are likely missing some php extension or have some issues in your installation.
- execute `php artisan migrate:fresh --seed`. This will run the migrations on your database, creating the relevant tables. And then seed the database with dummy data. Omit `--seed` if you do not want this dummy data.
- execute `php artisan serve`. This will start the local laravel server. I advise using a tool such as [Postman](https://www.postman.com/) to test/explore the routes.

For more information about the available routes: the `/` route contains a full list of all routes and some example inputs.

If you wish to set this project up on an actual server: [Servers for hackers](https://serversforhackers.com/) has a simple guide on how to set up a server with a laravel project.
