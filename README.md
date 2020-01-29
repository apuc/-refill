## Used frameworks
1. [Laravel 6.2]  
2. [Vue.js 2.6]


## Used main technologies
1. [Laravel Passport]
2. [Vuex]
3. [Vue Router]

## Installation

-Clone project

- Install components
```shell
composer install
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


- [Frontend README.md](https://github.com/apuc/-refill/blob/master/frontend/README.md)


[Laravel 6.2]: <https://laravel.com/>
[Laravel Passport]: <https://laravel.com/docs/6.x/passport>
[Vue.js 2.6]: <https://vuejs.org/>
[Vuex]: <https://vuex.vuejs.org/>
[Vue Router]: <https://router.vuejs.org/>
