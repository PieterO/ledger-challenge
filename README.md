# LedgerTechnical Challenge

![Unit and Functional Tests](https://github.com/PiOliver/loqbox-challenge-2020/workflows/Continuous%20Integration%20Laravel%206/badge.svg)

Small project as part of an application.

Please see the original specification and documentation inside `docs/`.

## Installation

Navigate to the cloned directory, then run
```bash
$ composer install
# generates public key
$ php artisan key:generate
```

then to configure a development sqlite version, run
```bash
touch database/database.sqlite
```

then add to the .env
```text
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite
```

this should get the backend working.


To build and compile frontend assets:
```bash
$ npm run install
$ npm run dev
```

## Contributing

Feel free to raise a pull request with any bug fixes or the improvements listed below.

## License

This uses the Laravel framework, which is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
