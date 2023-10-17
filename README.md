# MileApp Backend Test
You can use this API to access resources of MileApp Backend.

## Information

- PHP ^8.0
- Laravel 9
- MongoDB 4.0

## Installation

Clone repository:

    git clone https://github.com/agusamirudin25/backend-test.git

If you haven't installed mongoDB:

    sudo pecl install mongodb

Edit php.ini:

    extension="mongodb.so" 

Install all package with Composer:

    composer install
    composer update


Copy .env.example to .env

    cp .env.example > .env


Run command:

    php artisan key:generate
    php artisan migrate --seed

Run Test:

    php artisan test

## Application

- API Prefix http://mileapp-backend.test/api/v1/
- Collection Postman `MileApp Backend Test API.postman_collection.json`
- API Documentation [Documentation API](https://documenter.getpostman.com/view/12811496/2s9YR83sxx)


## Credits

* Author - [Agus Amirudin](https://www.linkedin.com/in/agus-amirudin/)

## License

license is [MIT](LICENSE).