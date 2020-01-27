## Installation

-Clone project
`git clone https://github.com/Leorne/payment.git`

- Install components
```shell
composer install
npm install
```
- Rename .env.example to .env and change DB settings

- Generate project key

`php artisan key:generate`

- Migrate database

`php artisan migrate`

- Init laravel:passport package

`php artisan passport:install --force`

- Seed database

`php artisan db:seed`

Test user:
email: test@test.test
password: test123
