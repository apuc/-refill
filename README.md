## Installation

-Clone project
`git clone https://github.com/MaximGos/project.git`

- Install components
```shell
composer install
npm install
```
- Rename .env.example to .env and change DB settings

- Generate project key

`php artisan key:generate`

- Init laravel:passport package

`php artisan passport:install --force`

- Create link to file storage

`php artisan storage:link`
