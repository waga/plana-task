# plana-task
PlanA [task](https://github.com/waga/plana-task/blob/master/task.txt)

# Backend requirements

php version is 7.2.23 with pdo_mysql.

Virtual host on apache with mod_rewrite, .htaccess inside public directory.

Configure virtual host DocumentRoot to point to [public](https://github.com/waga/plana-task/tree/master/backend/public)

mysql version 5.7.11, [sql structure](https://github.com/waga/plana-task/blob/master/backend/database.sql) needed for the solution to run properly.

[config](https://github.com/waga/plana-task/blob/master/backend/config/config.php) need to be modified properly.

composer is used for tests autoloading

to install dependencies (in [backend](https://github.com/waga/plana-task/tree/master/backend) directory)

```
composer install
```

# Backend tests

(in [backend](https://github.com/waga/plana-task/tree/master/backend) directory)

```
./vendor/bin/phpunit --bootstrap autoload.php tests
```

# Backend running

Inside [config](https://github.com/waga/plana-task/blob/master/backend/config/config.php) routes are stored

/api - API endpoint used in frontend to search by given address

For API management following routes are used:

/ui/api/list - List stored APIs

/ui/api/add - Add new API

/ui/api/edit/<id> - Edit API

/ui/api/delete/<id> - Delete API

# Frontend requirements

Angular 9

Nodejs 12.15.0

npm 6.13.7

to install dependencies (in [frontend](https://github.com/waga/plana-task/tree/master/frontend) directory)

```
npm install
```

API endpoint in [environment](https://github.com/waga/plana-task/blob/master/frontend/src/environments/environment.ts) and [prod environment](https://github.com/waga/plana-task/blob/master/frontend/src/environments/environment.prod.ts) need to be set properly.

# Frontend running

(in [frontend](https://github.com/waga/plana-task/tree/master/frontend) directory)

```
ng serve
```
